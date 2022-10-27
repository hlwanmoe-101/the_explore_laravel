<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
