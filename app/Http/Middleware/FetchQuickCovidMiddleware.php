<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\QuickStat;
use App\Jobs\SendEmailJob;
use App\Jobs\FetchCovidQuickJob;
class FetchQuickCovidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $latestQuickStat = QuickStat::latest()
                                    ->first();

        if(!is_null($latestQuickStat)) {
            $now = Carbon::now();

            $differenceInDays = $now->diffInDays($latestQuickStat->created_at);

            if($differenceInDays != 0) {
                $fetchJob = (new FetchCovidQuickJob())->delay(Carbon::now()->addSeconds(5));
                dispatch($fetchJob);
            }
        } else {
            $fetchJob = (new FetchCovidQuickJob())->delay(Carbon::now()->addSeconds(5));
            dispatch($fetchJob);
        }

        return $next($request);
    }
}
