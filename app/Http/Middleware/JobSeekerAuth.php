<?php

namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JobSeekerAuth extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = config('auth.guards');
        
        foreach( $guards as $guard => $guard_arr ){
            if( Auth::guard( $guard )->check() ){
                Auth::shouldUse( $guard );
            }
        }

        if( !Auth::check() || (Auth::user()->getTable() != 'job_seeker') ){
            return redirect('job-seeker');
        }
        
        return $next($request);
    }
}
