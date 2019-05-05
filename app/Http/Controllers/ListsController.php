<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\PostsList;
use App\Post;
use App\User;

class ListsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = PostsList::orderBy('created_at','desc')->paginate(10);
        return view('postsList.index')->with('lists',$lists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postsList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'visible' => 'required',
        ]);

        $list = new PostsList;
        $list->title = $request->input('title');
        $list->user_id = auth()->user()->id;
        $list->visible = (boolean) $request->visible;
        $list->save();

        return redirect('/listDashboard')->with('success', 'List Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = PostsList::find($id);
        $posts = Post::where('postList_id','=',$id)->paginate(10);
        $user = auth()->user();
        return view('postsList.show')->with('posts',$posts)->with('list',$list)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = PostsList::find($id);
        //Check for correct user
        if(auth()->user()->id != $list->user_id){
            return redirect('/postsList')->with('error','Unauthorized Page');
        }
        return view('postsList.edit')->with('list',$list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'visible' => 'required'
        ]);

        // Create post
        $list = PostsList::find($id);
        $list->title = $request->input('title');
        $list->visible = (bool) $request->input('visible');
    
        $list->save();

        return redirect('/listDashboard')->with('success', 'List Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = PostsList::find($id);
        //check for correct user
        if(auth()->user()->id != $list->user_id){
            return redirect('/postsList')->with('error','Unauthorized Page');
        }
        $posts = Post::where('postList_id','=',$list->id)->paginate(10);
        foreach($posts as $post){
            Storage::delete('public/cover_images/'.$post->cover_image);
            $post->delete();
            
        }
        $list->delete();
        return redirect('/listDashboard')->with('success', 'List Removed');
    }
}
