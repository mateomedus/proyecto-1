@extends('layouts.app')

@section('content')
    <h1>Are you sure you want to delete this post?</h1>
    <hr>
    <h2>Post name: {{$post->title}}</h2>
    <td>
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    </td>
    <br><br>
    <a href="/postDashboard/{{$post->postList_id}}" class="btn btn-primary">Go back</a>
@endsection