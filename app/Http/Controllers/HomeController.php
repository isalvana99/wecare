<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/index');
    }

    public function register_org()
    {
      return view('auth.registerorg');
    }

    public function adminlogin(){
        return view('auth.adminlogin');
    }

    public function demoonly(){
      
        return view('pages.homesampleonly');
    }

    public function demoonly2(){
    

        return view('pages.homesampleonly2');
    
    }
}
