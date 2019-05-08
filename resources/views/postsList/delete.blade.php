@extends('layouts.app')

@section('content')
    <h1>Are you sure you want to delete this list?</h1>
    <hr>
    <h2>List name: {{$list->title}}<h2>
    <a>
        {!!Form::open(['action' => ['ListsController@destroy', $list->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    </a>
    <a href="/listDashboard" class="btn btn-primary">Go back</a>
@endsection