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
        return view('profile.edit');
    }
    public function updateProfile(Request $request){
        $request->validate([
           "yourName"=>"required|min:3|max:50",
            "userPhoto"=>"nullable|mimes:jpeg,jpg,png|max:1000"
        ]);
        $user=User::find(auth()->user()->id);
        $user->name=$request->yourName;
        if($request->hasFile('userPhoto')){
            $dir="storage/profile";
            $newName="profile".uniqid().".".$request->file('userPhoto')->extension();
            $request->file('userPhoto')->storeAs("public/profile",$newName);
            $user->photo=$dir."/".$newName;
        }
        $user->update();
        return redirect()->back();
    }
    public function editPassword(){
        return view('profile.changePassword');
    }
    public function changePassword(Request $request){
        $request->validate([
            "currentPassword"=> "required|min:8",
            "newPassword"=> "required|min:8",
            "confirmPassword"=> "required|min:8|same:newPassword" 
        ]);
        if(!Hash::check($request->currentPassword,auth()->user()->password)){
            return redirect()->back()->withErrors(["currentPassword"=>"no"]);
        }
        $user=new User();
        $user->password=Hash::make($request->newPassword);
        $user->update();
        auth()->logout();
        return redirect()->route('login');
    }
}
