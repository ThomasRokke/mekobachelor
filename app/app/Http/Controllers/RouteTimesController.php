<?php

namespace App\Http\Controllers;


use App\Order;
use App\Route;
use App\RouteTimes;
use App\User;
use App\Workshop;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RouteTimesController extends Controller
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


    public function getRouteTimes(Request $request){

        $rtimes = RouteTimes::all();
        return view('routes.routetimes')->with(compact('rtimes'));
    }

    public function getEditRouteTimes(Request $request){

        $routetime = RouteTimes::find($request->id);
        return view('routes.editroutetimes')->with(compact('routetime'));
    }

    public function getCreateRouteTimes(){
        return view('routes.createroutetimes');
    }

    public function postcreateroutetime(Request $r){
        $r->validate([
            'route' => 'required',
            'time' => 'required',
            'from_time' => 'required',
            'to_time' => 'required',


        ]);


        $rt = new RouteTimes();

        $rt->route = $r->route;
        $rt->time = $r->time;
        $rt->from_time = $r->from_time;
        $rt->to_time = $r->to_time;

        $rt->save();

        return redirect(route('routetimes'));
    }

    public function deleteroutetimes(Request $r){
        $rt = RouteTimes::find($r->routetimeid);

        if(!empty($rt)){
            $rt->destroy($r->routetimeid);

            $rt->save();

            return redirect(route('routetimes'));

        }else{
            return redirect(route('routetimes'));
        }

    }

    public function postroutetimeedit(Request $r){

        $rt = RouteTimes::find($r->routetimeid);

        $rt->route = $r->route;
        $rt->time = $r->time;
        $rt->from_time = $r->from_time;
        $rt->to_time = $r->to_time;

        $rt->save();

        return redirect(route('routetimes'));


    }




    public function timeseed(){


        //Rute 10
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '08:00', 'from_time' => '00:00', 'to_time' => '07:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '10:00', 'from_time' => '07:45', 'to_time' => '09:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '12:00', 'from_time' => '09:45', 'to_time' => '11:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '14:00', 'from_time' => '11:45', 'to_time' => '13:45']);

        RouteTimes::firstOrCreate(['route' => 11, 'time' => '07:45', 'from_time' => '00:00', 'to_time' => '07:30']);
        RouteTimes::firstOrCreate(['route' => 11, 'time' => '09:45', 'from_time' => '07:30', 'to_time' => '09:30']);
        RouteTimes::firstOrCreate(['route' => 11, 'time' => '12:00', 'from_time' => '09:30', 'to_time' => '11:45']);
        RouteTimes::firstOrCreate(['route' => 11, 'time' => '14:00', 'from_time' => '11:45', 'to_time' => '13:45']);

        RouteTimes::firstOrCreate(['route' => 12, 'time' => '07:45', 'from_time' => '00:00', 'to_time' => '07:30']);
        RouteTimes::firstOrCreate(['route' => 12, 'time' => '09:45', 'from_time' => '07:30', 'to_time' => '09:30']);
        RouteTimes::firstOrCreate(['route' => 12, 'time' => '12:00', 'from_time' => '09:30', 'to_time' => '11:45']);
        RouteTimes::firstOrCreate(['route' => 12, 'time' => '14:00', 'from_time' => '11:45', 'to_time' => '13:45']);

        RouteTimes::firstOrCreate(['route' => 13, 'time' => '07:30', 'from_time' => '00:00', 'to_time' => '07:15']);
        RouteTimes::firstOrCreate(['route' => 13, 'time' => '09:45', 'from_time' => '07:30', 'to_time' => '09:30']);
        RouteTimes::firstOrCreate(['route' => 13, 'time' => '13:00', 'from_time' => '09:30', 'to_time' => '12:45']);

        RouteTimes::firstOrCreate(['route' => 14, 'time' => '07:45', 'from_time' => '00:00', 'to_time' => '07:30']);
        RouteTimes::firstOrCreate(['route' => 14, 'time' => '09:45', 'from_time' => '07:30', 'to_time' => '09:30']);
        RouteTimes::firstOrCreate(['route' => 14, 'time' => '12:00', 'from_time' => '09:30', 'to_time' => '11:45']);
        RouteTimes::firstOrCreate(['route' => 14, 'time' => '14:00', 'from_time' => '11:45', 'to_time' => '13:45']);


        $routeTimes = RouteTimes::all();
        dd($routeTimes);

    }
}
