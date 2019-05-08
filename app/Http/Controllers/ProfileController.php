<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255',],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/profile')->with('success', 'Profile Updated');
    }

    public function show($user_id){
        $user = User::find($user_id);
        return view('user.profile')->with('profile',$user);
    }
}
