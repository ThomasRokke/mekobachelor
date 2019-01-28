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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function getTransportHome(){
        return view('transport.home');
    }

    public function getRoutePreview(){
        return view('transport.route-preview');
    }


    public function getRouteStartKm()
    {
        return view('transport.route-startkm');
    }
    
    public  function getRouteEndKm(){
        return view('transport.route-endkm');

    }

    public function getRouteDrive(){
        return view('transport.route-drive');
    }
}

