<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Admin;
class CheckAdmin
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
        if ($request->session()->exists('id')) {
            $data = Admin::find(Session::get('id'));
            if ($data) {
                if ($data->accessright==0) {
                    return $next($request);
                }
            }
        }
        return redirect('/');
        
    }
}
