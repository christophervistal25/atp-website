<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
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
        $fetchJob = (new FetchCovidQuickJob())->delay(Carbon::now()->addSeconds(5));
        dispatch($fetchJob);
        return $next($request);
    }
}
