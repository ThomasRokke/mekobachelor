<?php

namespace App\Http\Controllers;

use App\Route;
use App\Stop;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DriverController extends Controller
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

    public function getRoutePreview(){

        //Set route position based on
        $routeToSet = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();


        $indexToSet =  array();
        foreach($routeToSet->stops as $s){
            if($s->workshop->prioritized !== null){
                array_push($indexToSet, ['id' => $s->id, 'pos' => $s->workshop->position]);

            }
        }


        //Sort the array to ensure lowest position is first.
        usort($indexToSet, function($a, $b) {
            return $a['pos'] - $b['pos'];
        });

        for($i = 0; $i < count($indexToSet); $i++){
            //Find stop
            $stop = Stop::find($indexToSet[$i]['id']);
            $stop->route_position = $i + 1;
            $stop->optimized = 1;

            $stop->save();
        }





        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();

        $stopsRaw = $route->stops;
        $stops = $stopsRaw;


        return view('driver.route-preview')->with(compact('route', 'stops'));

    }


    public function getRouteStartKm()
    {
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();


        return view('driver.route-startkm')->with(compact('route'));

    }

    public function setRouteStartKm(Request $request){
        $route = Route::find($request->routeid);
        $route->started = 1;
        $route->kmstart = $request->kmstart;
        $route->started_time = new DateTime('now');

        $route->save();

        return redirect(route('transport.route-drive'));
    }

    public function getRouteDrive(){
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();

        $stops = $route->stops;







        return view('driver.route-active')->with(compact('route', 'stops'));

    }

    public  function getRouteEndKm(Request $request){
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::find($request->id);

        return view('driver.route-endkm')->with(compact('route'));

    }

    public function setRouteEndKm(Request $request){
        $route = Route::find($request->id);

        $optTime = Carbon::parse($route->optimized_time);
        $now = Carbon::now();

        $diffInMinutes = $optTime->diffInMinutes($now, false);

        if($route->lunch_break === 1){
            $diffInMinutes = $diffInMinutes - 30;
        }


        $route->finished = 1;
        $route->kmend = $request->kmend;
        $route->active = 0;
        $route->finished_time = new DateTime('now');
        $route->time_diff = $diffInMinutes;
        //optimized_time

        $route->save();



        return redirect(route('transport.route-report', ['id' => $route->id]));


    }



    public function getRouteReport(Request $request) {
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::find($request->id);



        return view('driver.route-report')->with(compact('route'));

    }


    public function markdelivered(Request $request){


        $stop = Stop::find($request->id);




        foreach($stop->orders as $order){
            $ordnr = $order->ordernumber;

            if($request->$ordnr === 'on'){
                $order->delivered = 1;

            }else{
                $order->delivered = 0;

            }

            $order->save();
        }

        //$table->boolean('delivered')->default(0);
        //$table->time('deliver_time')->nullable();

        $stop->delivered = 1;

        $stop->deliver_time = new DateTime('now');


        $stop->save();



        //Set route position based on
        $routeToSet = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();

        $amountPrio = 0;
        $amountDelivered = 0;
        $lastPos = 0;
        $otherExits = false;
        foreach($routeToSet->stops as $s){
            if($s->workshop->prioritized !== null || $s->route_position !== null ){

                $lastPos = $s->route_position;
                $amountPrio++; //Amount of prioritized

                if($s->delivered === 1){
                    $lastPos = $s->route_position;
                    $amountDelivered++;
                }
            }else{
                $otherExits = true;
            }
        }



        //If you have delivered all the prioritized orders and if others exits. Run the optimization algorithm
        if($amountDelivered === $amountPrio && $otherExits){
            return redirect(route('optimize', ['route_id' => $stop->route->id]));
        }else{
            return redirect()->back();
        }







    }

    //optimize with google!!!
    public function optimize(Request $request){
        // https://maps.googleapis.com/maps/api/directions/json?origin=place_id:ChIJDS_Xlr1vQUYR_DoZm2txJhg&destination=place_id:ChIJDS_Xlr1vQUYR_DoZm2txJhg&waypoints=optimize:true|via:place_id:ChIJ2WDjTRhuQUYR1_zDeFG9iBA|via:place_id:ChIJE45MHl1uQUYRcXmbvjUpf04&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ

        // https://maps.googleapis.com/maps/api/directions/json?origin=Adelaide,SA&destination=Adelaide,SA&waypoints=optimize:true|Barossa+Valley,SA|Clare,SA|Connawarra,SA|McLaren+Vale,SA&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ

        $route = Route::find($request->route_id);





        $lastPrioStop = $route->stops->where('route_position', '!==', null)->sortBy('route_position')->last();

        $prevPrioExits = false;
        if(!empty($lastPrioStop)){
            $startPlaceID = $lastPrioStop->workshop->place_id;
            $prevPrioExits = true;
        }else{
            //Set startID as the same as Mekonomen Oslo
            $startPlaceID = "ChIJDS_Xlr1vQUYR_DoZm2txJhg";

        }



        $stops = $route->stops->where('route_position', '===', null);

        $countStops = count($stops);



        $stopArray = [];

        foreach($stops as $stop){
            array_push($stopArray, $stop->workshop->adr, $stop);
            //$stopArray[$i] = [$stops[$i]->workshop->adr, $stops[$i]];
        }


        $waypointsString = '';

        foreach ($stops as $stop){

            $waypointsString .= '|place_id:' . $stop->workshop->place_id;
        }



        $waypoints = "|place_id:ChIJ4eGnUL58QUYRf_PNdGhDisI|place_id:ChIJp2K8RTtlQUYRDBL_VduyAOA|place_id:ChIJ4eGnUL58QUYRf_PNdGhDisI";

        // dd($route);
        //new GuzzleHttp\Client;
        $client = new Client();
        //base url + the query provided by the user
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=place_id:".$startPlaceID."&destination=place_id:EiNTbWFsdm9sbHZlaWVuIDQ3LCAwNjY3IE9zbG8sIE5vcndheQ&waypoints=optimize:true".$waypointsString."&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ";
        //https://maps.googleapis.com/maps/api/place/autocomplete/json?input=thon+osl&key=AIzaSyApvbnXANxqHKHaZ4A23LrdvMOSlRh1r8M
        //sends a get request with the auth information in the header + the generated URL.
        $responseRaw = $client->get($url);
        //grab the returned information body information and decode it to JSON format.
        $responseDecodet = json_decode($responseRaw->getBody(), true);



        //  dd($responseDecodet);

        //dd($responseDecodet['routes'][0]['legs']);
        //Save the route polylines to be displayed at map.
        $route->map_polylines = $responseDecodet['routes'][0]['overview_polyline']['points'];

        $route->save();

        // dd($responseDecodet['routes'][0]['waypoint_order'][0]);

        $amount = count($responseDecodet['routes'][0]['legs']);

        if($prevPrioExits){
            $startPosition = $lastPrioStop->route_position + 1;
        }else{
            $startPosition = 1;
        }




        $amount = $amount - 1;

        $totalDuration = 0;

        //TODO:: KEEP THE SAME SHIET
        // dd($responseDecodet['routes'][0]['legs']);
        // dd($responseDecodet);
        for($i = 0; $i < $amount; $i++){


            $legadr = $responseDecodet['routes'][0]['legs'][$i]['end_address'];

            //Duration in seconds + 30 that is the average drop time
            $duration = $responseDecodet['routes'][0]['legs'][$i]['duration']['value'] + 30;


            $totalDuration = $totalDuration + $duration;



            //dd($responseDecodet['routes'][0]['legs'][$i]);

            foreach ($stops as $stop){

                if($stop->workshop->adr == $legadr){

                    if($prevPrioExits){
                        $stop->route_position = $lastPrioStop->route_position + 1 + $i;
                    }else{
                        $stop->route_position = 1 +  $i;
                    }

                    $stop->save();


                }else{
                    //dd($stop->workshop->adr);

                }
            }

        }
        //Set the optimized time to the total duration

        $now = new DateTime('now');
        $now->modify('+ '.$totalDuration.' seconds');



        $route->optimized_time = $now;
        $route->save();

        //new DateTime('now');


        /*
        for($i = 0; $i < $countStops; $i++){
            $stop = $stopArray[$i][1];

           // dd($stop);
            $stop->route_position = $responseDecodet['routes'][0]['waypoint_order'][$i];
            $stop->save();


        }
        */



        return redirect(route('transport.route-drive'));


    }


    public function undodelivered(Request $request){
        $stop = Stop::find($request->id);


        foreach($stop->orders as $order){
            $order->delivered = 0;

        }


        $stop->delivered = 0;

        $stop->deliver_time = null;

        $stop->save();

        return redirect()->back();
    }

    public function setLunch(Request $request){
        $route = Route::find($request->route_id);

        $route->lunch_break = 1;

        $route->save();

        return redirect()->back();
    }

    public function undoLunch(Request $request){
        $route = Route::find($request->route_id);

        $route->lunch_break = 0;

        $route->save();

        return redirect()->back();
    }

}
