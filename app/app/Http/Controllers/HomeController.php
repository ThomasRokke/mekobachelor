<?php

namespace App\Http\Controllers;

use App\Order;
use App\Route;
use App\RouteTimes;
use App\Stop;
use App\User;
use App\Workshop;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\DB;

use App\Charts\SampleChart;

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

    public function getMap(){

        $routes = Route::where('date', '>', date('Y/m/d', strtotime('-10 days')))->get();



        $activeCount = count($routes);


// ...

        /*
        $chartData = collect([]); // Could also be an array

        for ($days_backwards = 2; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $chartData->push(Order::whereDate('created_at', today()->subDays($days_backwards))->count());
        }

        $chart = new SampleChart;
        $chart->labels(['2 days ago', 'Yesterday', 'Today']);
        $chart->dataset('Antall ordre', 'line', $chartData);
        */

        $data = Route::groupBy('route')
            ->get()
            ->map(function ($item) {

                //Count number of stops on the route

                return count($item->stops);
            });



        $chart = new SampleChart;
        $chart->labels($data->keys());
        $chart->dataset('My dataset', 'line', $data->values());

        return view( 'map')->with(compact('routes', 'activeCount', 'chart'));
    }

    public function getMyProfile(){
        $user = Auth::user();
        return view('pages.myprofile')->with(compact('user'));
    }


    public function getEditWorkshop(Request $request){
        $w = Workshop::find($request->workshop_id);

        return view('pages.editworkshop')->with(compact('w'));
    }

    public function postworkshopedit(Request $request){
        //create new workshop instance
        $w = Workshop::find($request->wid);
        $w->workshop_id = $request->workshop_id;
        $w->name = $request->name;
        $w->route = $request->route;
        $w->lat = $request->lat;
        $w->lng = $request->lng;
        $w->adr = $request->adr;
        $w->place_id = $request->fromID;

        //save the new record
        $w->save();

        //redirect to the workshop overview
        return redirect(route('proto.protoworkshop'));
    }

    public function getRouteTimes(Request $request){

        $rtimes = RouteTimes::all();
        return view('pages.routetimes')->with(compact('rtimes'));
    }

    public function getEditRouteTimes(Request $request){

        $routetime = RouteTimes::find($request->id);
        return view('pages.editroutetimes')->with(compact('routetime'));
    }

    public function getCreateRouteTimes(){
        return view('pages.createroutetimes');
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

    public function getOrderStatus(Request $request){

        $ord = $request->ordernumber;


        $order = Order::where('ordernumber', '=', $ord)->first();


        return view('pages.orderstatus')->with(compact('order', 'ord'));
    }

    public function getOrders(Request $request){

        $orders = Order::all();

        return view('office.orders')->with(compact('orders'));
    }

    public function searchWorkshops(Request $request){
       $workshops = DB::table('workshops')->where('name', 'like', '%' . $request->q . '%')->get();

        return response()->json($workshops);
    }

    public function getPrototest(Request $request){

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



        return view('office.prototest')->with(compact('routeObjects', 'route_times', 'routes', 'drivers', 'driversStatus', 'halvsju', 'atte', 'ti', 'tolv', 'ett', 'to', 'kveld', 'date', 'orders', 'workshop_id', 'workshops'));
    }

    public function getPrototest2(Request $request){

        if(!empty($request->date)){
            $date = $request->date;
        }else{
            $date = date('Y/m/d');
        }

        $halvsju = Route::where('date',  $date)->where('time', '07:30:00')->get();
        $atte = Route::where('date', '=',  $date)->where('time', '=', '08:00:00')->get();
        $ti = Route::where('date', '=',  $date)->where('time', '=', '10:00:00')->get();
        $tolv = Route::where('date', '=',  $date)->where('time', '=', '12:00:00')->get();
        $to = Route::where('date', '=',  $date)->where('time', '=', '14:00:00')->get();
        $kveld = Route::where('date', '=',  $date)->where('time', '=', '17:30:00')->get();




        $orders = Order::paginate(15);
// $games->results = the 30 you asked for
// $games->links() = the links to next, previous, etc pages

       // dd($halvsju[0]->stops[0]->workshop->name);

        $routes = Route::where('date',  $date)->get();

       // dd($routes);

        $drivers = User::all();

        return view('office.prototest2')->with(compact('routes', 'drivers', 'halvsju', 'atte', 'ti', 'tolv', 'to', 'kveld', 'date', 'orders'));
    }

    public function getPrototestHome(){


        return view('office.prototesthome');
    }

    public function getProtoRoles(){

        $users = User::all();

        $roles = Role::all();

        return view('pages.users')->with(compact('users', 'roles'));
    }



    public function getProtoWorkshops(){

        $workshops = Workshop::all();

        return view('officeproto.workshops')->with(compact('workshops'));
    }

    public function getProtoWorkshopCreate(){
        return view('officeproto.workshopscreate');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $user = Auth::user();

        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->get();


        return view('pages.home')->with(compact('route'));

    }

    public function userRoles(){

        $users = User::all();

        return view('office.roles')->with(compact('users'));
    }

    public function editUser($id){


        $user = User::find($id);
        return view('office.edituser')->with(compact('user'));
    }

    public function storeEditUser(Request $request){
        //Validate the request. Except that the email should be unique - we check for that later.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'userid' => ['required'],
        ]);
        //Gets the user object before any changes is being conducted
        $user = User::find($request->userid);

        //Checks if email is the same as the previous one
        if($user->email !== $request->email){
            //If the new email is already in use
            if (User::where('email', $request->email) !== null) {
                //Return back with input
                return redirect()->back()->withInput();
            }
        }

        //Unattach all roles
        $user->detachAllRoles();

        //Attach role provided by request
        $user->attachRole($request->role);

        $user->name = $request->name;
        $user->email = $request->email;


        //save the user model
        $user->save();

        return redirect()->route('office.userroles');

    }


    public function attachAdmin($id){
        $user = User::find($id);

        $user->detachAllRoles();
        //attach admin role
        $user->attachRole(1);


        if ($user->hasRole('admin')) { // you can pass an id or slug
            dd('user is now admin');
        }
    }

    public function setRole(Request $request){

        //TODO: Fix permissions so only the correct people are able to give the roles.

        //Find the user to append the role to
        $user = User::find($request->user_id);

        $user->detachAllRoles();
        //attach given role based on role_id
        $user->attachRole($request->role_id);


        return redirect(route('proto.protoroles'));



    }


    public function attachOffice($id){
        $user = User::find($id);

        $user->detachAllRoles();
        //attach office role
        $user->attachRole(2);

        if ($user->hasRole('office')) { // you can pass an id or slug
            dd('user is now office role');
        }
    }

    public function attachUser($id){
        $user = User::find($id);

        $user->detachAllRoles();
        //attach admin role
        $user->attachRole(3);

        if ($user->hasRole('user')) { // you can pass an id or slug
            dd('user is now user');
        }
    }

        //Unused - functionality is set in 'index'
    public function getTransportHome(){
        return view('transport.home');
    }

    public function getRoutePreview(){

        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();

        $stopsRaw = $route->stops;


        if(!empty($stopsRaw[0]->route_position)){
            $stops = $stopsRaw->sortBy('route_position');
        }else{
            $stops = $stopsRaw;
        }


        return view('pages.route-preview')->with(compact('route', 'stops'));

    }


    public function getRouteStartKm()
    {
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();


        return view('pages.route-startkm')->with(compact('route'));

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

        return redirect()->back();

    }

    public function undodelivered(Request $request){
        $stop = Stop::find($request->id);


        foreach($stop->orders as $order){
            $order->delivered = 0;

        }

        //$table->boolean('delivered')->default(0);
        //$table->time('deliver_time')->nullable();

        $stop->delivered = 0;

        $stop->deliver_time = null;

        $stop->save();

        return redirect()->back();
    }

    public function drivestart(){
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();

        $stopsRaw = $route->stops;


        if(!empty($stopsRaw[0]->route_position)){
            $stops = $stopsRaw->sortBy('route_position');
        }else{
            $stops = $stopsRaw;
        }




        return view('drivestart')->with(compact('route', 'stops'));

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

        $stopsRaw = $route->stops;


        if(!empty($stopsRaw[0]->route_position)){
            $stops = $stopsRaw->sortBy('route_position');
        }else{
            $stops = $stopsRaw;
        }


        return view('pages.route-active')->with(compact('route', 'stops'));

    }

    public  function getRouteEndKm(Request $request){
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::find($request->id);

        return view('pages.route-endkm')->with(compact('route'));

    }

    public function setRouteEndKm(Request $request){
        $route = Route::find($request->id);


        $route->finished = 1;
        $route->kmend = $request->kmend;
        $route->active = 0;
        $route->finished_time = new DateTime('now');

        $route->save();



        return redirect(route('transport.route-report', ['id' => $route->id]));


    }



    public function getRouteReport(Request $request) {
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::find($request->id);



        return view('pages.route-report')->with(compact('route'));

    }

    //Workshops

    public function getWorkshops(){

        //Create workshops
        $workshops = Workshop::all();
        return view('office.workshops')->with(compact('workshops'));
    }

    public function getCreateWorkshops(){
        return view('office.workshop-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCreate(Request $request)
    {

        $request->validate([
            'workshop_id' => 'required|unique:workshops|max:6|min:6',
            'name' => 'required',
            //'lat' => 'required',
            //'lng' => 'required'

        ]);

        //create new workshop instance
        $w = new Workshop;
        $w->workshop_id = $request->workshop_id;
        $w->name = $request->name;
        $w->route = $request->route;
        $w->lat = $request->lat;
        $w->lng = $request->lng;
        $w->adr = $request->adr;
        $w->place_id = $request->fromID;

        //save the new record
        $w->save();

        //redirect to the workshop overview
        return redirect(route('proto.protoworkshop'));
    }

    public function searchGoogleAutocomplete($session, $query){
        // replace whitespace with + sign
        $trimmedQuery = str_replace(" ", "+", $query);

        //new GuzzleHttp\Client;
        $client = new Client();
        //base url + the query provided by the user
        //$url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$trimmedQuery."&key=AIzaSyApvbnXANxqHKHaZ4A23LrdvMOSlRh1r8M";
        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=".$trimmedQuery."&components=country:no|country:se|country:dk&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ";
        //https://maps.googleapis.com/maps/api/place/autocomplete/json?input=thon+osl&key=AIzaSyApvbnXANxqHKHaZ4A23LrdvMOSlRh1r8M
        //sends a get request with the auth information in the header + the generated URL.
        $responseRaw = $client->get($url);
        //grab the returned information body information and decode it to JSSON format.
        $responseDecodet = json_decode($responseRaw->getBody(), true);



        //return the resposne in Json format.11
        return response()->json($responseDecodet);
    }

    //Save or update the place id in the in database.
    public function searchplacesapi(Request $request){




        //new GuzzleHttp\Client;
        $client = new Client();
        //base url + the query provided by the user
        $url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=".$request->placeid."&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ";
        //https://maps.googleapis.com/maps/api/place/autocomplete/json?input=thon+osl&key=AIzaSyApvbnXANxqHKHaZ4A23LrdvMOSlRh1r8M
        //sends a get request with the auth information in the header + the generated URL.
        $responseRaw = $client->get($url);
        //grab the returned information body information and decode it to JSSON format.
        $responseDecodet = json_decode($responseRaw->getBody(), true);






        return response()->json($responseDecodet);
    }

    /*
     *  Office routes
     * */
    public function getRoutes(){


        $routes = Route::all();
        $users = User::all();
        return view('office.routes')->with(compact('routes', 'users'));
    }

    public function getWorkshopInfo(Request $request){

        $q = $request->q;

        $workshops = Workshop::where('workshop_id', '=', $q)->first();



        return response()->json($workshops);
    }

    public function getEdit(Request $request){

        $order = Order::where('ordernumber', $request->id)->first();


        return view('pages.editorder')->with(compact('order'));
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






        return redirect(route('proto.prototest', ['date' => $r->date]));

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
        return redirect(route('proto.prototest'));


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

//optimize with google!!!
    public function optimize(Request $request){
        // https://maps.googleapis.com/maps/api/directions/json?origin=place_id:ChIJDS_Xlr1vQUYR_DoZm2txJhg&destination=place_id:ChIJDS_Xlr1vQUYR_DoZm2txJhg&waypoints=optimize:true|via:place_id:ChIJ2WDjTRhuQUYR1_zDeFG9iBA|via:place_id:ChIJE45MHl1uQUYRcXmbvjUpf04&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ

        // https://maps.googleapis.com/maps/api/directions/json?origin=Adelaide,SA&destination=Adelaide,SA&waypoints=optimize:true|Barossa+Valley,SA|Clare,SA|Connawarra,SA|McLaren+Vale,SA&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ


        $route = Route::find($request->route_id);

        $countStops = count($route->stops);


        $stopArray = [];

        for($i = 0; $i < $countStops; $i++){
            $stopArray[$i] = [$route->stops[$i]->workshop->adr, $route->stops[$i]];
        }



        //dd($stopArray);

        $waypointsString = '';

        foreach ($route->stops as $stop){

            $waypointsString .= '|place_id:' . $stop->workshop->place_id;
        }





        $waypoints = "|place_id:ChIJ4eGnUL58QUYRf_PNdGhDisI|place_id:ChIJp2K8RTtlQUYRDBL_VduyAOA|place_id:ChIJ4eGnUL58QUYRf_PNdGhDisI";

        // dd($route);
        //new GuzzleHttp\Client;
        $client = new Client();
        //base url + the query provided by the user
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=place_id:ChIJDS_Xlr1vQUYR_DoZm2txJhg&destination=place_id:EiNTbWFsdm9sbHZlaWVuIDQ3LCAwNjY3IE9zbG8sIE5vcndheQ&waypoints=optimize:true".$waypointsString."&key=AIzaSyA7eRw8L-VehjHMRGTjPtkt7dCgaQFUcJQ";
        //https://maps.googleapis.com/maps/api/place/autocomplete/json?input=thon+osl&key=AIzaSyApvbnXANxqHKHaZ4A23LrdvMOSlRh1r8M
        //sends a get request with the auth information in the header + the generated URL.
        $responseRaw = $client->get($url);
        //grab the returned information body information and decode it to JSSON format.
        $responseDecodet = json_decode($responseRaw->getBody(), true);




        //dd($responseDecodet);

        //dd($responseDecodet['routes'][0]['legs']);
        // dd($responseDecodet['routes'][0]['waypoint_order'][0]);

        $amount = count($responseDecodet['routes'][0]['legs']);



        // dd($responseDecodet['routes'][0]['legs']);

        for($i = 1; $i < $amount; $i++){


            $legadr = $responseDecodet['routes'][0]['legs'][$i]['start_address'];

            foreach ($route->stops as $stop){
                if($stop->workshop->adr === $legadr){
                    $stop->route_position = $i;
                    $stop->save();
                }
            }




        }



        /*
        for($i = 0; $i < $countStops; $i++){
            $stop = $stopArray[$i][1];

           // dd($stop);
            $stop->route_position = $responseDecodet['routes'][0]['waypoint_order'][$i];
            $stop->save();


        }
        */


        return back();


    }




}

