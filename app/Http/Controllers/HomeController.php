<?php

namespace App\Http\Controllers;
use Auth;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(Auth::user()->role_id == '1' && Auth::user()->isleaseout == '0') {
            return redirect()->intended('/user');
        }  elseif (Auth::user()->role_id == '1' && Auth::user()->isleaseout =='1') {
            return redirect()->intended('/leaseoutuser');
        } else if (Auth::user()->role_id == '2') {
            return redirect()->intended('/admin');
        } else {
            return view('home');
        }
    }
}
