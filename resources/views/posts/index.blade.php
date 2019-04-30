@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <hr>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row bg-white rounded border border-info">
                    <div class="col-md-3 col-sm-3">
                        <img style="width:90%" src="{{$post->cover_image}}">
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <br>
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
                <br>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection