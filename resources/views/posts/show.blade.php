@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <br/>
    <div>{!!$post->body!!}</div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-default"> Edit</a>
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
    
    <br/><br/><br/>
    <a href="/posts" class="btn btn-primary">Go back</a>
@endsection