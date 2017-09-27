<?php

namespace App\Http\Middleware;

use Closure;
use Jenssegers\Agent\Agent;
use App\Audit as Auditor;

class Audit
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

        $agent = new Agent();


        if ( \Auth::check() ) {

            Auditor::create([
                'user_id'    => \Auth::user()->id,
                'method'     => $request->getMethod(),
                'path' => $request->getPathInfo(),
                'query'      => $request->getQueryString(),
                'userAgent' => $agent->getUserAgent(),
                'ip'        => \Request::ip(),
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'isDesktop' => $agent->isDesktop(),
                'isMobile' => $agent->isMobile(),
                'isPhone' => $agent->isPhone(),
                'isTablet' => $agent->isTablet()
            ]);
        }

        return $next($request);
    }
}
