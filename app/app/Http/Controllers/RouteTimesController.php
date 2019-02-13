<?php

namespace App\Http\Controllers;

use App\RouteTimes;
use Illuminate\Http\Request;

class RouteTimesController extends Controller
{


    public function timeseed(){



        RouteTimes::firstOrCreate(['route' => 10, 'time' => '08:00', 'from_time' => '00:00', 'to_time' => '07:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '10:00', 'from_time' => '07:45', 'to_time' => '09:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '12:00', 'from_time' => '09:45', 'to_time' => '11:45']);
        RouteTimes::firstOrCreate(['route' => 10, 'time' => '14:00', 'from_time' => '11:45', 'to_time' => '13:45']);

        $routeTimes = RouteTimes::all();
        dd($routeTimes);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RouteTimes  $routeTimes
     * @return \Illuminate\Http\Response
     */
    public function show(RouteTimes $routeTimes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RouteTimes  $routeTimes
     * @return \Illuminate\Http\Response
     */
    public function edit(RouteTimes $routeTimes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RouteTimes  $routeTimes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RouteTimes $routeTimes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RouteTimes  $routeTimes
     * @return \Illuminate\Http\Response
     */
    public function destroy(RouteTimes $routeTimes)
    {
        //
    }
}
