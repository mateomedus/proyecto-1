<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect('/')->with('error','Unauthorized Page');
        }

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('user.profile')->with('profile', $user);
    }

    public function edit(){
        if(!Auth::check()){
            return redirect('/')->with('error','Unauthorized Page');
        }

        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('user.edit')->with('profile', $user);

    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'email' => 'required'
        ]);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        return redirect('/profile')->with('success', 'Profile Updated');
    }

    public function show($user_id){
        $user = User::find($user_id);
        return view('user.profile')->with('profile',$user);
    }
}
