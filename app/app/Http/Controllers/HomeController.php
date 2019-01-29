<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;

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

        $user = Auth::user();

        //If the user have the role of admin or office
        if ($user->hasRole(['admin', 'office'])) { // you can pass an id or slug

            return view('home');
        }
        //If the user have the role of User.
        else{

            return view('transport.home');
        }

    }



    public function attachAdmin($id){
        $user = User::find($id);


        //attach admin role
        $user->attachRole(1);

        if ($user->hasRole('admin')) { // you can pass an id or slug
            dd('user is now admin');
        }
    }

    public function attachOffice($id){
        $user = User::find($id);


        //attach office role
        $user->attachRole(4);

        if ($user->hasRole('office')) { // you can pass an id or slug
            dd('user is now office role');
        }
    }

    public function attachUser($id){
        $user = User::find($id);


        //attach admin role
        $user->attachRole(2);

        if ($user->hasRole('user')) { // you can pass an id or slug
            dd('user is now user');
        }
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

    public function getRouteReport() {
        return view('transport.route-report');
    }
}

