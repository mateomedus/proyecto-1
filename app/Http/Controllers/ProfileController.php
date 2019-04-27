<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('user.profile')->with('profile', $user);
    }

    public function edit(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('user.edit')->with('profile', $user);

    }

    public function update(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect('/profile')->with('success', 'Profile Updated');
    }
}
