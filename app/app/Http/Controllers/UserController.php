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

        $users = User::all();

        $roles = Role::all();

        return view('users.users')->with(compact('users', 'roles'));
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
}
