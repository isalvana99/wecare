<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        if (Auth::guard($guards)->check()) {
               $role = Auth::user()->role; 
        

            switch ($role) {
              case 'ADMIN':
                 return redirect(RouteServiceProvider::HOME_ADMIN);
                 break;
              case 'USER':
                 return redirect(RouteServiceProvider::HOME);
                 break;
              case 'ORG':
                return redirect(RouteServiceProvider::HOME);
                break; 
        
              default:
                 return redirect(RouteServiceProvider::LANDINGPAGE); 
                 break;
            }
          }
          //   if (Auth::guard($guards)->check()) {
          //     $temp = Auth::user()->role; 
          //     $role = "";

          //     if($temp == "USER" || $temp == "ORG")
          //     {
          //       $role = "USER";
          //       return redirect(RouteServiceProvider::HOME);
          //     }else if($temp == "ADMIN"){
          //       $role = "ADMIN";
          //       return redirect(RouteServiceProvider::HOME_ADMIN);
          //     }else{
          //       return redirect(RouteServiceProvider::LANDINGPAGE); 
          //     }

          //  }
          

         return $next($request);
    }
}
