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


    public function wtest(){
        $stops = Stop::all();
        $workshops = Workshop::paginate(10);


        return view('pages.wtest')->with(compact('stops', 'workshops'));
    }

    public function wtestStart(){
        return view('pages.wteststart');
    }


    public function wtestSecond(){
        return view('pages.wsecond');
    }


    public function getAbout(){
        return view('pages.about');
    }




/*
    public function getEditWorkshop(Request $request){
        $w = Workshop::find($request->workshop_id);

        return view('workshops.editworkshop')->with(compact('w'));
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

    public function getOrderStatus(Request $request){

        $ord = $request->ordernumber;


        $order = Order::where('ordernumber', '=', $ord)->first();


        return view('pages.orderstatus')->with(compact('order', 'ord'));
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

        return view('routes.routes2')->with(compact('routes', 'drivers', 'halvsju', 'atte', 'ti', 'tolv', 'to', 'kveld', 'date', 'orders'));
    }

    public function getPrototestHome(){


        return view('routes.routeshome');
    }





    public function getProtoWorkshops(){

        $workshops = Workshop::all();

        return view('workshops.workshops')->with(compact('workshops'));
    }

    public function getProtoWorkshopCreate(){
        return view('workshops.workshopscreate');
    }



    public function userRoles(){

        $users = User::all();

        return view('office.roles')->with(compact('users'));
    }

    public function editUser($id){


        $user = User::find($id);
        return view('users.edituser')->with(compact('user'));
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






    //Workshops

    public function getWorkshops(){

        //Create workshops
        $workshops = Workshop::all();
        return view('office.workshops')->with(compact('workshops'));
    }

    public function getCreateWorkshops(){
        return view('office.workshop-create');
    }


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




*/












}
