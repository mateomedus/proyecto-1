<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('user.profile')->with('profile', $user);
    }
}
