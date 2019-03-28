<?php

namespace App\Http\Controllers;


use App\Charts\SampleChart;
use App\Order;
use App\Route;
use Illuminate\Support\Facades\Request;

class AnalyticsController extends Controller
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


    public function getDashboard(){

        $routes = Route::where('date', '>', date('Y/m/d', strtotime('-10 days')))->get();



        $activeCount = count($routes);


        $data = Route::groupBy('route')
            ->get()
            ->map(function ($item) {

                //Count number of stops on the route

                return count($item->stops);
            });



        $chart = new SampleChart;
        $chart->labels($data->keys());
        $chart->dataset('My dataset', 'line', $data->values());

        return view( 'analytics.dashboard')->with(compact('routes', 'activeCount', 'chart'));
    }


    public function getDataexport(Request $request){

        $orders = Order::all();

        return view('analytics.dataexport')->with(compact('orders'));
    }
}
