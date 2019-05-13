<?php

namespace App\Http\Controllers;



use App\Workshop;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WorkshopController extends Controller
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


    public function getWorkshops(){

        $workshops = Workshop::all();

        return view('workshops.workshops')->with(compact('workshops'));
    }

    public function getWorkshopCreate(){
        return view('workshops.workshopscreate');
    }

    public function storeCreateWorkshop(Request $request)
    {

        $request->validate([
            'workshop_id' => 'required|unique:workshops|max:6|min:6',
            'name' => 'required',
            'route' => 'required',
            'place_id' => 'required'
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


    public function getEditWorkshop(Request $request){
        $w = Workshop::find($request->workshop_id);

        return view('workshops.editworkshop')->with(compact('w'));
    }

    public function postworkshopedit(Request $request){

        $request->validate([
            'workshop_id' => 'required|unique:workshops|max:6|min:6',
            'name' => 'required',
            'route' => 'required',
            'fromID' => 'required'
            //'lat' => 'required',
            //'lng' => 'required'

        ]);
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

    public function searchWorkshops(Request $request){
        $workshops = DB::table('workshops')->where('name', 'like', '%' . $request->q . '%')->get();

        return response()->json($workshops);
    }

    public function prioritize(Request $request){
        $route = $request->route;
        if(empty($route)){
            $route = "10";
        }

        $workshops = Workshop::where('route', $route)->get();

        $prio = Workshop::where('prioritized', 1)->where('route', $route)->orderBy('position')->get();
        return view('routes.prioritize')->with(compact('workshops', 'prio', 'route'));
    }

    public function priopost(Request $request){
        $inputs = $request->input();
        $route = $request->route;

        $workshops = Workshop::where('route', $route)->get();
        //Reset all workshops
        foreach($workshops as $w){
            $w->prioritized = null;
            $w->position = null;
            $w->save();
        }

        foreach ($inputs as $key => $value){
            if($key !== "_token" && $key !== "route"){
                $w = Workshop::where('workshop_id', $key)->first();
                $w->prioritized = 1;
                $w->position = $value;
                $w->save();

            }
        }


        return redirect(route('prioritize', ['route' => $route]));

        //  $table->boolean('prioritized')->nullable();
        //            $table->integer('position')->nullable();
    }
}
