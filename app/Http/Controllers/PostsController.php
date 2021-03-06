<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\PostsList;
use App\User;

class PostsController extends Controller
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
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('posts.create')->with('list_id',$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$list_id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|required|max:1999'
        ]);

        // Handle file upload
        $request->hasFile('cover_image');
        // Get filename with the extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //Get just extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // Filename to store
        $filenameToStore = $filename.'_'.time().'.'.$extension;
        // Upload the image
        $request->file('cover_image')->move(base_path().'/public/images/', $filenameToStore);

        // Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->postList_id = $list_id;
        $post->cover_image = $filenameToStore;
        $post->save();
        
        return redirect('/postDashboard/'.$post->postList_id)->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $list = PostsList::where('id','=',$post->postList_id)->first();
        $user = User::where('id','=',$list->user_id)->first();
        return view('posts.show')->with('post',$post)->with('list',$list)->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $list = PostsList::where('id','=',$post->postList_id)->first();
        //Check for correct user
        if(auth()->user()->id != $list->user_id){
            return redirect('/postsList')->with('error','Unauthorized Page');
        }
        return view('posts.edit')->with('post',$post);
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
            'body' => 'required'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload the image
            $path = $request->file('cover_image')->move(base_path().'/public/images/', $filenameToStore);
        }

        // Create post
        $post = Post::find($id);
        $list = PostsList::where('id','=',$post->postList_id)->first();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $filenameToStore;
        }
        $post->save();

        $postList_id = auth()->user()->id;
        return redirect('/postDashboard/'.$list->id)->with('success', 'Post Updated')->with('list',$list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $list = PostsList::where('id','=',$post->postList_id)->first();
        //check for correct user
        if(auth()->user()->id != $list->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        Storage::delete('public/cover_images/'.$post->cover_image);
        $post->delete();
        return redirect('/postDashboard/'.$post->postList_id)->with('success', 'Post Removed');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        return view('posts.delete')->with('post',$post);
    }
}
