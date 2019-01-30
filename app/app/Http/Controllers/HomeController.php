<?php

namespace App\Http\Controllers;

use App\Order;
use App\Route;
use App\Stop;
use App\User;
use App\Workshop;
use DateTime;
use GuzzleHttp\Client;
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


            return view('office.home');
        }
        //If the user have the role of User.
        else{

            //get all routes with my driver id that is active
            // TODO: add where this date = bla bla
            $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();
            return view('transport.home')->with(compact('route'));
        }

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


        return view('transport.route-preview')->with(compact('route', 'stops'));

    }


    public function getRouteStartKm()
    {
        //get all routes with my driver id that is active
        // TODO: add where this date = bla bla
        $route = Route::where('driver_id', Auth::user()->id)->where('active', 1)->first();


        return view('transport.route-startkm')->with(compact('route'));

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
    
    public  function getRouteEndKm(){
        return view('transport.route-endkm');

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


        return view('transport.route-drive')->with(compact('route', 'stops'));

    }

    public function getRouteReport() {
        return view('transport.route-report');
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
        $w->lat = $request->lat;
        $w->lng = $request->lng;
        $w->adr = $request->adr;
        $w->place_id = $request->fromID;

        //save the new record
        $w->save();

        //redirect to the workshop overview
        return redirect(route('office.workshops'));
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


    public function postRoute(Request $request){
        $request->validate([
            'workshop_id' => 'required|exists:workshops|max:6|min:6',
            'ordernumber' => 'required|unique:orders',
            'route' => 'required|max:2|min:2'
        ]);

        $wid = $request->workshop_id;

        //TODO: Perform a check if there there is any active route that this stop could be put in.

        $r = Route::firstOrCreate(['date' => '2019/01/01', 'route' => $request->route, 'time' => '12:00']);

        $w = Workshop::where('workshop_id', $wid)->first();



        $s = Stop::firstOrCreate(['route_id' => $r->id, 'workshop_id' => $wid]);


        $o = new Order;
        $o->ordernumber = $request->ordernumber;
        $o->stop_id = $s->id;
        $o->workshop_id = $wid;
        $o->save();


        return redirect(route('office.routes'));


    }


    public function setDriver(Request $request){

        $route_id = $request->route_id;
        $driver_id = $request->driver_id;




        $route = Route::find($route_id);

        $route->driver_id = $driver_id;

        $route->save();


        return back();

    }

    public function setActive(Request $request){
        $route_id = $request->route_id;


        $route = Route::find($route_id);

        $route->active = 1;

        $route->save();


        return back();
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
