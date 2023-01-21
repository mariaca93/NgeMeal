<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
class NoUserAuthMiddleware
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
        if (Auth::user()) {
            return redirect('profile');
        }
        return $next($request);
    }
}