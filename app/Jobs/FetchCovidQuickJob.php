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

    private function fetch()
    {
        $client = new \GuzzleHttp\Client();
        // Send an asynchronous request.
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://covid19stats.ph/api/stats/location');
        $promise = $client->sendAsync($request)->then(function ($response) {

            $data   = json_decode($response->getBody(), true);
            $cities = [];

            foreach($data['cities'] as $city) {
                if(\Str::contains($city['slug'], 'surigao-del-sur')) {
                    $cities[] = $city;
                }
            }

            QuickStat::firstOrCreate([
                'surigao_confirmed'     => array_sum(array_column($cities, 'total')),
                'surigao_recovered'     => array_sum(array_column($cities, 'recovered')),
                'surigao_deaths'        => array_sum(array_column($cities, 'deaths')),
            ]);

        });
        $promise->wait();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->fetch();
    }
}
