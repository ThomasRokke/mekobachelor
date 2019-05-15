<?php

namespace App\Http\Controllers;


use App\Charts\SampleChart;
use App\Order;
use App\Route;
use App\Stop;
use App\User;
use Carbon\Carbon;
use Countable;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            case "1":
                $returnString = 'mon';
                break;

            case "2":
                $returnString = 'tue';
                break;

            case "3":
                $returnString = 'wen';
                break;

            case "4":
                $returnString = 'thu';
                break;

            case "5":
                $returnString = 'fri';
                break;


        }

        return $returnString;

    }

    public function getDashboard(Request $request){
        if(Auth::user()->level() < 2) {
            return response('Unauthorized.', 401);
        }


        if(empty($request->time)){
            $time = "7";
        }else{
            $time = $request->time;
        }

        $route_number = null;
        if(!empty($request->route)){
            $route_number = $request->route;
        }

        $driver = User::find($request->driver_id);

        $routes = null;
        if($driver !== null){
            if($route_number === null){
                $routes = Route::where('date', '>=', date('Y/m/d', strtotime('- '.$time.' days')))->where('finished', 1)->where('driver_id', '=', $driver->id)->get();

            }else{
                $routes = Route::where('date', '>=', date('Y/m/d', strtotime('- '.$time.' days')))->where('finished', 1)->where('driver_id', '=', $driver->id)->where('route', '=', $route_number)->get();

            }
        }
        elseif ($driver === null && $route_number !== null) {
            $routes = Route::where('date', '>=', date('Y/m/d', strtotime('- '.$time.' days')))->where('finished', 1)->where('route', '=', $route_number)->get();

        }else{
            $routes = Route::where('date', '>=', date('Y/m/d', strtotime('- '.$time.' days')))->where('finished', 1)->get();
        }





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

        $antHenteOrdre = 0;

        $totalRoutes = is_array($routes) || $routes instanceof Countable ? count($routes) : 0;
        foreach($routes as $r){

            $startTime = Carbon::parse($r->started_time);
            $stopTime = Carbon::parse($r->finished_time);

            $diffInMinutes = $startTime->diffInMinutes($stopTime, false);


            $totalTime += $diffInMinutes;



            $totalKM += $r->kmend - $r->kmstart; //Get routes KM

            $stopsArr = $r->stops;

            $stops += is_array($stopsArr) || $stopsArr instanceof Countable ? count($stopsArr) : 0;



            foreach($stopsArr as $s){

                //Check henteordre
                foreach($s->orders as $o){
                    if($o->ordernumber <= 60000 && $o->ordernumber >= 200){
                        $antHenteOrdre++;
                    }

                }

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

                $orders += is_array($ordersArr) || $ordersArr instanceof Countable ? count($ordersArr) : 0;

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





        $route_routes = DB::table('route_times')->select('route')->distinct()->orderBy('route')->get();

        $users = User::all();


        return view( 'analytics.dashboard')->with(compact('routes','antHenteOrdre', 'totalRoutes', 'users', 'route_number', 'driver', 'route_routes', 'activeCount', 'chart', 'orders', 'stops', 'totalKM', 'totalHours', 'totalMinutes',
            'ant10', 'ant11', 'ant12', 'ant13', 'ant14', 'time', 'mon10', 'mon11','mon12', 'mon13', 'mon14',
            'tue10', 'tue11','tue12', 'tue13', 'tue14', 'wen10', 'wen11','wen12', 'wen13', 'wen14', 'thu10', 'thu11','thu12', 'thu13', 'thu14', 'fri10', 'fri11','fri12', 'fri13', 'fri14'
        ));
    }


    public function getDataexport(Request $request){

        $orders = Order::all();

        return view('analytics.dataexport')->with(compact('orders'));
    }
}
