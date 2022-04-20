<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('home');
    }

    public function editProfile(){
        return view('profile.edit-profile');
    }

    public function updateProfile(Request $request){

        if($request->hasFile('photo')){
            $dir = "storage/profile";
            $newName = 'profile_'.uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs('public/profile',$newName);
        }

        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->hasFile('photo')){
            $user->photo = $dir."/".$newName;
        }
        $user->update();
        return redirect()->back();
    }

    public function editPassword(){
        return view('profile.edit-password');
    }

    public function updatePassword(Request $request){

        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        ]);

        if(!Hash::check($request->old_password,auth()->user()->password)){
            return redirect()->back()->withErrors('old_password',"password don't match");
        }

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->update();
        auth()->logout();

        return redirect()->route('login');
    }
}
