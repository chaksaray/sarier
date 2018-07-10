<?php

namespace App\Http\Middleware;

use Closure;
use Config;
class CheckPlatform
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
        if (!session(Config::get('constant.global_name.PLATFORM'))) {
            return redirect('install');
        }
        return $next($request);
    }
}
