<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Ka2Middleware
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
        $icon = 1;

        if($request->icon == null){
            $icon = rand(0,6);
        }

        $user = [

            'mail'=>$request->mail,
            'login'=>$request->login,
            'password'=>$request->password,
            'repassword'=>$request->repassword,
            'icon'=>$icon,
        ];

        $request->merge(['user'=>$user]);

        return $next($request);
    }
}
