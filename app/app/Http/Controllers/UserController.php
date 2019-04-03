<?php

namespace App\Http\Controllers;



use App\User;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
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

    public function getMyProfile(){
        $user = Auth::user();
        return view('users.myprofile')->with(compact('user'));
    }

    public function getRoles(){
        //If the user is over level 2 - aka office
        if(Auth::user()->level() < 2) {
            return response('Unauthorized.', 401);
        }
        $users = User::all();

        $roles = Role::all();

        return view('users.users')->with(compact('users', 'roles'));
    }

    public function setRole(Request $request){
        //If the user is over level 4 - aka admin
        if(Auth::user()->level() < 4) {
            return response('Unauthorized.', 401);
        }


        //Find the user to append the role to
        $user = User::find($request->user_id);

        $user->detachAllRoles();
        //attach given role based on role_id
        $user->attachRole($request->role_id);


        return redirect(route('proto.protoroles'));



    }

    public function getCreateUser(){
        if(Auth::user()->level() < 4) {
            return response('Unauthorized.', 401);
        }
        return view('users.createuser');
    }

    public function getEditUser(Request $request){
        //If the user is over level 4 - aka admin
        if(Auth::user()->level() < 4) {
            return response('Unauthorized.', 401);
        }

        $user = User::find($request->user_id);
        return view('users.edituser')->with(compact('user'));
    }

    public function postEditUser(Request $request){
        //If the user is over level 4 - aka admin
        if(Auth::user()->level() < 4) {
            return response('Unauthorized.', 401);
        }

        $request->validate([
            'id' => 'required|exists:users',
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $user = User::find($request->id);

        //Check if the email the user provided is the same
        if($user->email !== $request->email){

            //Check if the new user email already exists.
            if(User::where('email', '=', $request->email)->exists()) {
                $request->session()->flash('negative', $request->email.' er allerede i bruk av noen andre.');
                return back()->withInput();
            }
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $request->session()->flash('regconfirm', $request->email.' har blitt endret.');
        return redirect(route('proto.protoroles'));
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
}
