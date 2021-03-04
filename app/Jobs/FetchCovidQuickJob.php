<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\QuickStat;
use Carbon\Carbon;

class FetchCovidQuickJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lastFetchTime = App\QuickStat::latest()->first(['created_at']);
        if(!is_null($lastFetchTime) && Carbon::now()->diffInDays($lastFetchTime->created_at) != 0) {
            $client = new \GuzzleHttp\Client();
            // Send an asynchronous request.
            $request = new \GuzzleHttp\Psr7\Request('GET', 'https://covid19stats.ph/api/stats/location');
            $promise = $client->sendAsync($request)->then(function ($response) {
                QuickStat::create([
                    'surigao_confirmed'     => '10',
                    'surigao_recovered'     => '10',
                    'surigao_deaths'        => '10',
                    'philippines_confirmed' => '10',
                    'philippines_recovered' => '10',
                    'philippines_deaths'    => '10',
                    'world_wide_confirmed'  => '10',
                    'world_wide_recovered'  => '10',
                    'world_wide_deaths'     => '10',
                ]);
            });
            $promise->wait();
        } 
    }
}
