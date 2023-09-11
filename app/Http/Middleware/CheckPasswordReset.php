<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordReset
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // $user = Auth::id();
        // dd(auth()->user());

        if(auth()->user()->password_update == 1){
            return $next($request);
        }
        
        // dd('hello world');
        else{
            return redirect('/reset-password');
        }
    }
}
