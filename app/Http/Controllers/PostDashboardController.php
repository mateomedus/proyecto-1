<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\PostsList;

class PostDashboardController extends Controller
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
    public function show($id)
    {
        $posts = Post::where('postList_id','=',$id)->paginate(10);
        $list = PostsList::find($id);

        return view('postDashboard')->with('posts', $posts)->with('list_id',$id)->with('list',$list);
    }
}
