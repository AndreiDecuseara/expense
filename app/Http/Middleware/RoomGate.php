<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Helpers\Helper;

class RoomGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(env('SECURITY')){
            $user = User::find($request->user);
            if($user){
                if($this->ip() == $user->ip){
                    return $next($request);
                }
            }
        }else{
            return $next($request);
        }
        return abort(403, 'Unauthorized action.');
    }

    public function ip()
    {
        $helper = new Helper();
        return $helper->getIp(); // the above method
    }
}
