<?php

namespace App\Http\Controllers;


use App\Order;
use App\Route;
use App\RouteTimes;
use App\Stop;
use App\User;
use App\Workshop;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RouteController extends Controller
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


    public function getRoutes(Request $request){

        //If the user is over level 2 - aka office
        if(Auth::user()->level() < 2) {
            return response('Unauthorized.', 401);
        }

        if(!empty($request->date) && $request->date !== "null"){
            $date = $request->date;

        }else{
            $date = date('Y/m/d');
        }

        //Get me the distinct times found in the route_times table and order them by time.
        //Results will be in the lines of 08:00:00, 09:00:00, 10:00:00 etc.
        $route_times = DB::table('route_times')->select('time')->distinct()->orderBy('time')->get();


        $timesArray = $route_times->toArray();

        $routeObjects = array();
        // dd($timesArray[0]->time);
        foreach($route_times as $t){

            array_push($routeObjects, Route::where('date',  $date)->where('time', $t->time)->get());
        }





        $halvsju = Route::where('date',  $date)->where('time', '07:30:00')->get();
        $atte = Route::where('date', '=',  $date)->where('time', '=', '08:00:00')->get();
        $ti = Route::where('date', '=',  $date)->where('time', '=', '10:00:00')->get();
        $tolv = Route::where('date', '=',  $date)->where('time', '=', '12:00:00')->get();

        $ett = Route::where('date', '=',  $date)->where('time', '=', '13:00:00')->get();
        $to = Route::where('date', '=',  $date)->where('time', '=', '14:00:00')->get();
        $kveld = Route::where('date', '=',  $date)->where('time', '=', '17:30:00')->get();




        //Get the recently registered orders. Order by created at DESC and limit the search to 10.
        $orders = Order::orderBy('created_at', 'desc')->paginate(50);



// $games->results = the 30 you asked for
// $games->links() = the links to next, previous, etc pages

        // dd($halvsju[0]->stops[0]->workshop->name);

        $routes = Route::where('date',  $date)->get();


        // dd($routes);

        /* $drivers = User::with('route')->whereHas('route', function($q){
             $q->where('active', '=', 1);
         })->get();
        */
        $driversStatus =  Route::where('active', 1)->get();


        $drivers = User::all();


        //If the user is clicking a link on the search workshops functionality.
        $workshop_id = null;

        if(!empty($request->workshop_id)){
            $workshop_id = $request->workshop_id;

            $request->request->remove('workshop_id');
        }


        //Get henteordre - We get from workshops now, but we will change it later on
        $workshops = Workshop::all();



        return view('routes.routes')->with(compact('routeObjects', 'route_times', 'routes', 'drivers', 'driversStatus', 'halvsju', 'atte', 'ti', 'tolv', 'ett', 'to', 'kveld', 'date', 'orders', 'workshop_id', 'workshops'));
    }

    public function postRoute(Request $request){

        $request->validate([
            'workshop_id' => 'required|exists:workshops|max:8|min:6',
            'ordernumber' => 'required|unique:orders',
        ]);

        $route = null;
        $routeSet = false;
        //If the user have specified the route
        if(!empty($request->route)){
            $route = $request->route;
            $routeSet = true;
            //Else - give the default route specified in the workshop table.
        }else{
            $workshop = Workshop::where('workshop_id', '=', $request->workshop_id)->first();
            $route = $workshop->route;


        }
        //22:32:33
        $timeStamp = date('H:i:s'); //'08:32:33'; //



        //Set the time if it have not yet been specified
        $timeSet = false;
        $time = null;


        $date = null;
        $dateSet = false;
        if(!empty($request->time)){
            $time = $request->time;
            $timeSet = true;


        }else{


            //TODO: Set the timestamp to current time - manually set it for testing purposes.



            $response = RouteTimes::where('route', '=', $route)
                ->where('from_time', '<=', $timeStamp)
                ->where('to_time', '>=', $timeStamp)
                ->first();

            //If there is any response within the daily timespans.
            if(!empty($response)){
                $time = $response->time;
                $timeSet = true;
                $date = date('Y/m/d'); // set to todays date
                $dateSet = true;
            }else{
                $timeObj = RouteTimes::where('route', '=', $route)
                    ->orderBy('time', 'ASC')
                    ->first();

                $time = $timeObj->time;
                $timeSet = true;

                $date = \Carbon\Carbon::tomorrow()->format('Y/m/d');
                $dateSet = true;

            }

        }
        //time is now set




        $date = null;
        $dateSet = false;
        if(!empty($request->date)){
            $date = $request->date;
            $dateSet = true;
        }else{

            $newTime = new \Carbon\Carbon($time, 'Europe/London');

            $newTime = $newTime->subMinutes(15);

            $newTime = $newTime->format('H:i');

            $timeLimit = $newTime;

            //If there is any response within the daily timespans.
            //if(Carbon::now()->lessThan($timeLimit)){
            if($timeStamp  <= $timeLimit){

                $date = date('Y/m/d'); // set to todays date
                $dateSet = true;

            }else{

                $date = \Carbon\Carbon::tomorrow()->format('Y/m/d');
                $dateSet = true;

            }

        }




        if(!empty($request->amount)){
            $amount = $request->amount;
            $amountComment = $request->amountcomment;

        }else{
            $amount = null;
            $amountComment = null;
        }

        $wid = $request->workshop_id;

        //TODO: Perform a check if there there is any active route that this stop could be put in.

        $r = Route::firstOrCreate(['date' => $date, 'route' => $route, 'time' => $time]);

        $w = Workshop::where('workshop_id', $wid)->first();



        $s = Stop::firstOrCreate(['route_id' => $r->id, 'workshop_id' => $wid]);

        $kkodeBolean = 0;
        //Check if the order is K-Kode - is a boolean.
        if(!empty($request->kkode)){
            $kkode= $request->kkode;
            if($kkode === "on"){
                $kkodeBolean = 1;
            }
        }


        $o = new Order;
        $o->ordernumber = $request->ordernumber;
        $o->stop_id = $s->id;
        $o->workshop_id = $wid;
        $o->amount = $amount;
        $o->amount_comment = $amountComment;
        $o->kkode = $kkodeBolean;
        $o->save();


        $sessionString = "Ordren ble lagt til på rute ".$r->route. " klokken ". $r->time. " den " . date('d M', strtotime($date)) . ". Ordrenummeret er: ".$o->ordernumber;

        //dd($sessionString);

        $request->session()->flash('regconfirm', $sessionString);
        return redirect(route('routes'));


    }

    public function postHente(Request $request){
        $request->validate([
            'workshop_id' => 'required|exists:workshops|max:8|min:6',
        ]);

        //Create a new range of ordernumber from 2000 to 4000.
        $rangeStart = 2000;
        $ordnr = null;
        //Check if the ordernumber exits
        $ordExists = Order::where('ordernumber', $rangeStart)->first();
        if(!empty($ordExists)){
            $prevTakenOrd = Order::where('ordernumber', '>=', 2000)
                ->where('ordernumber', '<=', 6000)
                ->orderBy('ordernumber', 'DESC')->first();

            $prevOrdnr = $prevTakenOrd->ordernumber;
            //Set ordnr to one plus 1
            $ordnr = $prevOrdnr + 1;

        }else{
            $ordnr = $rangeStart;
        }




        $route = null;
        $routeSet = false;
        //If the user have specified the route
        if(!empty($request->route)){
            $route = $request->route;
            $routeSet = true;
            //Else - give the default route specified in the workshop table.
        }else{
            $workshop = Workshop::where('workshop_id', '=', $request->workshop_id)->first();
            $route = $workshop->route;


        }
        //22:32:33
        $timeStamp = date('H:i:s'); //'08:32:33'; //



        //Set the time if it have not yet been specified
        $timeSet = false;
        $time = null;


        $date = null;
        $dateSet = false;
        if(!empty($request->time)){
            $time = $request->time;
            $timeSet = true;


        }else{


            //TODO: Set the timestamp to current time - manually set it for testing purposes.



            $response = RouteTimes::where('route', '=', $route)
                ->where('from_time', '<=', $timeStamp)
                ->where('to_time', '>=', $timeStamp)
                ->first();

            //If there is any response within the daily timespans.
            if(!empty($response)){
                $time = $response->time;
                $timeSet = true;
                $date = date('Y/m/d'); // set to todays date
                $dateSet = true;
            }else{
                $timeObj = RouteTimes::where('route', '=', $route)
                    ->orderBy('time', 'ASC')
                    ->first();

                $time = $timeObj->time;
                $timeSet = true;

                $date = \Carbon\Carbon::tomorrow()->format('Y/m/d');
                $dateSet = true;

            }

        }
        //time is now set




        $date = null;
        $dateSet = false;
        if(!empty($request->date)){
            $date = $request->date;
            $dateSet = true;
        }else{

            $newTime = new \Carbon\Carbon($time, 'Europe/London');

            $newTime = $newTime->subMinutes(15);

            $newTime = $newTime->format('H:i');

            $timeLimit = $newTime;

            //If there is any response within the daily timespans.
            //if(Carbon::now()->lessThan($timeLimit)){
            if($timeStamp  <= $timeLimit){

                $date = date('Y/m/d'); // set to todays date
                $dateSet = true;

            }else{

                $date = \Carbon\Carbon::tomorrow()->format('Y/m/d');
                $dateSet = true;

            }

        }




        if(!empty($request->amount)){
            $amount = $request->amount;
            $amountComment = $request->amountcomment;

        }else{
            $amount = null;
            $amountComment = null;
        }

        $wid = $request->workshop_id;

        //TODO: Perform a check if there there is any active route that this stop could be put in.

        $r = Route::firstOrCreate(['date' => $date, 'route' => $route, 'time' => $time]);

        $w = Workshop::where('workshop_id', $wid)->first();



        $s = Stop::firstOrCreate(['route_id' => $r->id, 'workshop_id' => $wid]);

        $kkodeBolean = 0;
        //Check if the order is K-Kode - is a boolean.
        if(!empty($request->kkode)){
            $kkode= $request->kkode;
            if($kkode === "on"){
                $kkodeBolean = 1;
            }
        }



        $o = new Order;
        $o->ordernumber = $ordnr;
        $o->stop_id = $s->id;
        $o->workshop_id = $wid;
        $o->amount = $amount;
        $o->amount_comment = $amountComment;
        $o->kkode = $kkodeBolean;
        $o->save();


        $sessionString = "Henteordren ble lagt til på rute ".$r->route. " klokken ". $r->time. " den " . date('d M', strtotime($date)) . ". Ordrenummeret er: ".$o->ordernumber;

        //dd($sessionString);

        $request->session()->flash('regconfirm', $sessionString);
        return redirect(route('routes'));


    }

    public function getWorkshopInfo(Request $request){

        $q = $request->q;

        $workshops = Workshop::where('workshop_id', '=', $q)->first();



        return response()->json($workshops);
    }

    public function setDriver(Request $request){

        $route_id = $request->route_id;
        $driver_id = $request->driver_id;


        $driver = User::find($driver_id);

        $route = Route::find($route_id);

        $route->driver_id = $driver_id;

        $route->save();

        $flashString = $driver->name.' er registrert på rute '.$route->route.' klokken '.date('H:i.', strtotime($route->time));
        $request->session()->flash('regconfirm', $flashString);

        return back();


    }

    public function setActive(Request $request){
        $route_id = $request->route_id;


        $route = Route::find($route_id);

        $driver = null;

        $driver = User::find($route->driver_id);

        //Does the route have any connected driver?
        if(empty($driver)){
            $request->session()->flash('negative', 'Du har ikke valgt noen sjåfør. Vennligst velg en sjåfør og prøv på nytt.');
            return back();
        }

        //If it's a connected driver but it already assigned to an active route.
        elseif(!empty(Route::where('driver_id', $driver->id)->where('active', 1)->first())){

            $request->session()->flash('negative', 'Sjåføren er allerede knyttet til en annen aktiv rute. Vennligst fullfør ruten eller bytt sjåfør.');
            return back();

        }
        else{
            $route->active = 1;

            $route->save();

            $flashString = 'Rute '.$route->route.' klokken '.date('H:i', strtotime($route->time)). ' som kjøres av '.$driver->name.' er satt som aktiv.';
            $request->session()->flash('regconfirm', $flashString);
            return back();
        }







    }

    public function setInactive(Request $request){
        $route_id = $request->route_id;


        $route = Route::find($route_id);

        $route->active = 0;

        $route->save();


        return back();
    }

    public function getEdit(Request $request){

        $order = Order::where('ordernumber', $request->id)->first();


        return view('routes.editorder')->with(compact('order'));
    }
    public function postEdit(Request $request){

        if($request->old_ordernumber == $request->ordernumber){

            $order = Order::where('ordernumber', $request->ordernumber)->first();

            $oldRoute = Route::find($request->old_route);
            $oldStop = Stop::find($request->old_stop);


            $r = Route::firstOrCreate(['date' => $request->date, 'route' => $request->route, 'time' => $request->time]);

            $w = Workshop::where('workshop_id', $request->workshop_id)->first();


            $s = Stop::firstOrCreate(['route_id' => $r->id, 'workshop_id' => $w->workshop_id]);

            $kkodeBolean = 0;
            //Check if the order is K-Kode - is a boolean.
            if(!empty($request->kkode)){
                $kkode= $request->kkode;
                if($kkode === "on"){
                    $kkodeBolean = 1;
                }
            }

            if(!empty($request->amount)){
                $amount = $request->amount;

            }else{
                $amount = null;

            }

            $order->amount = $amount;
            $order->kkode = $kkodeBolean;

            $order->ordernumber = $request->ordernumber;
            $order->workshop_id = $w->workshop_id;
            $order->stop_id = $s->id;
            $order->workshop_id = $request->workshop_id;


            $order->save();



            //TODO: Remove old stops or route if they do not contain anything
            if($oldStop->id == $s->id){

            }else{
                if(Stop::find($oldStop->id)->orders->count() == 0){
                    Stop::destroy($oldStop->id);

                }
                if(Route::find($oldRoute->id)->stops->count() == 0){
                    Route::destroy($oldRoute->id);

                }

            }
        }else{
            $order = Order::where('ordernumber', $request->ordernumber)->first();
            if(empty($order)){

                $old_order = Order::where('ordernumber', $request->old_ordernumber)->first();

                $oldRoute = Route::find($request->old_route);
                $oldStop = Stop::find($request->old_stop);


                $r = Route::firstOrCreate(['date' => $request->date, 'route' => $request->route, 'time' => $request->time]);

                $w = Workshop::where('workshop_id', $request->workshop_id)->first();


                $s = Stop::firstOrCreate(['route_id' => $r->id, 'workshop_id' => $w->workshop_id]);

                $kkodeBolean = 0;
                //Check if the order is K-Kode - is a boolean.
                if(!empty($request->kkode)){
                    $kkode= $request->kkode;
                    if($kkode === "on"){
                        $kkodeBolean = 1;
                    }
                }

                if(!empty($request->amount)){
                    $amount = $request->amount;

                }else{
                    $amount = null;

                }

                $old_order->amount = $amount;
                $old_order->kkode = $kkodeBolean;

                $old_order->ordernumber = $request->ordernumber;
                $old_order->workshop_id = $w->workshop_id;
                $old_order->stop_id = $s->id;
                $old_order->workshop_id = $request->workshop_id;


                $old_order->save();



                //TODO: Remove old stops or route if they do not contain anything
                if($oldStop->id == $s->id){

                }else{
                    if(Stop::find($oldStop->id)->orders->count() == 0){
                        Stop::destroy($oldStop->id);

                    }
                    if(Route::find($oldRoute->id)->stops->count() == 0){
                        Route::destroy($oldRoute->id);

                    }

                }

            }

            else{
                $request->session()->flash('negative', 'Ordrenummeret du forsøkte å bytte til er allerede tatt.');
                return back();
            }

        }






        return redirect(route('routes', ['date' => $r->date]));

    }
}
