<?php

namespace App\Http\Controllers;


use App\Charts\SampleChart;
use App\Order;
use App\Route;
use App\Stop;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

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


    public function weekDay($date){

        $weekday = date('w', strtotime($date));

        $returnString = null;
        switch ($weekday) {
            case "0":
                $returnString = 'mon';
                break;

            case "1":
                $returnString = 'tue';
                break;

            case "2":
                $returnString = 'wen';
                break;

            case "3":
                $returnString = 'thu';
                break;

            case "4":
                $returnString = 'fri';
                break;


        }

        return $returnString;

    }

    public function getDashboard(Request $request){

        if(empty($request->time)){
            $time = "7";
        }else{
            $time = $request->time;
        }




        $routes = Route::where('date', '>', date('Y/m/d', strtotime('- '.$time.' days')))->where('finished', 1)->get();

        $mon10 = [0, 0, 0];
        $mon11 = [1, 0, 0];
        $mon12 = [2, 0, 0];
        $mon13 = [3, 0, 0];
        $mon14 = [4, 0, 0];

        $tue10 = [0, 1, 0];
        $tue11 = [1, 1, 0];
        $tue12 = [2, 1, 0];
        $tue13 = [3, 1, 0];
        $tue14 = [4, 1, 0];

        $wen10 = [0, 2, 0];
        $wen11 = [1, 2, 0];
        $wen12 = [2, 2, 0];
        $wen13 = [3, 2, 0];
        $wen14 = [4, 2, 0];

        $thu10 = [0, 3, 0];
        $thu11 = [1, 3, 0];
        $thu12 = [2, 3, 0];
        $thu13 = [3, 3, 0];
        $thu14 = [4, 3, 0];

        $fri10 = [0, 4, 0];
        $fri11 = [1, 4, 0];
        $fri12 = [2, 4, 0];
        $fri13 = [3, 4, 0];
        $fri14 = [4, 4, 0];

        //Calculate total amount of orders and stops
        $orders = 0;
        $stops = 0;
        $totalKM = 0;
        $totalTime = null;

        $ant10 = 0;
        $ant11 = 0;
        $ant12 = 0;
        $ant13 = 0;
        $ant14 = 0;


        foreach($routes as $r){

            $startTime = Carbon::parse($r->started_time);
            $stopTime = Carbon::parse($r->finished_time);

            $diffInMinutes = $startTime->diffInMinutes($stopTime, false);


            $totalTime += $diffInMinutes;



            $totalKM += $r->kmend - $r->kmstart; //Get routes KM

            $stopsArr = $r->stops;
            $stops += sizeof($stops); //Get amount of stops

            foreach($stopsArr as $s){
                switch ($r->route) {
                    case 10:
                        $ant10++;
                        $weekday = $this->weekday($r->date);
                        if($weekday !== null) {
                            ${$weekday . '10'}[2] = ${$weekday . '10'}[2] + 1;
                        }

                        break;

                    case 11:
                        $ant11++;
                        $weekday = $this->weekday($r->date);
                        if($weekday !== null) {
                            ${$weekday . '11'}[2] = ${$weekday . '11'}[2] + 1;
                        }
                        break;

                    case 12:
                        $ant12++;
                        $weekday = $this->weekday($r->date);
                        if($weekday !== null){
                            ${$weekday.'12'}[2] = ${$weekday.'12'}[2] + 1;
                        }

                        break;

                    case 13:
                        $ant13++;
                        $weekday = $this->weekday($r->date);
                        if($weekday !== null) {
                            ${$weekday . '13'}[2] = ${$weekday . '13'}[2] + 1;
                        }
                        break;

                    case 14:
                        $ant14++;
                        $weekday = $this->weekday($r->date);
                        if($weekday !== null) {
                            ${$weekday . '14'}[2] = ${$weekday . '14'}[2] + 1;
                        }
                        break;



                }
                $ordersArr = $s->orders;
                $orders += sizeof($ordersArr); //Get amount of orders

            }

        }
        $totalHours = floor($totalTime / 60);
        $totalMinutes = $totalTime % 60;





        //TODO: Calculate total amount of orders





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








        return view( 'analytics.dashboard')->with(compact('routes', 'activeCount', 'chart', 'orders', 'stops', 'totalKM', 'totalHours', 'totalMinutes',
            'ant10', 'ant11', 'ant12', 'ant13', 'ant14', 'time', 'mon10', 'mon11','mon12', 'mon13', 'mon14',
            'tue10', 'tue11','tue12', 'tue13', 'tue14', 'wen10', 'wen11','wen12', 'wen13', 'wen14', 'thu10', 'thu11','thu12', 'thu13', 'thu14', 'fri10', 'fri11','fri12', 'fri13', 'fri14'
            ));
    }


    public function getDataexport(Request $request){

        $orders = Order::all();

        return view('analytics.dataexport')->with(compact('orders'));
    }
}
