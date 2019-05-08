@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <hr>
    <img style="width:100" src="/images/{{$post->cover_image}}">
    <br><br>
    <div>{!!$post->body!!}</div>
    <hr>
    <small>Written on {{$post->created_at}} by <a href="/profile/{{$user->id}}">{{$user->name}}</a></small>
    <hr>
    @if(!Auth::guest()) 
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default"> Edit</a>
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <br><br>
<a href="/postsList/{{$post->postList_id}}" class="btn btn-primary">Go back</a>
@endsection