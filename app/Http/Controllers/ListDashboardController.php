<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PostsList;

class ListDashboardController extends Controller
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
        $user_id = auth()->user()->id;
        $lists = PostsList::where('user_id','=',$user_id)->paginate(10);

        return view('listDashboard')->with('lists', $lists);
    }
}
