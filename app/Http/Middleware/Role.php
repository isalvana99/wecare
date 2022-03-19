<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, String $role) {
    if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('/');

    $user = Auth::user();

    // $temp = Auth::user()->role; 
    // $role1 = "";

    // if($user->role == "USER" || $user->role == "ORG")
    // {
    //   $role1 = "USER";
    // }else{
    //   $role1 = "ADMIN";
    // }

    //  if($role1 == $role || $role1 == $role)
    //     return $next($request);

    if($user->role == $role)
      return $next($request);

    return redirect('/');
  }
}