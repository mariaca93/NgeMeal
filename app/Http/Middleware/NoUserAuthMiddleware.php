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
        if (Auth::user() && Auth::user()->type == 2) {
            // $url = url()->previous();
            // $route = app('router')->getRoutes($url)->match(app('request')->create($url))->getName();

            // if($route == 'adduser') {
            //     return redirect('login');
            // }
            return redirect('profile');
        }
        return $next($request);
    }
}