@extends('layouts.app')

@section('content')
    <h1>Create List</h1>
    {{ Form::open(['action' => 'ListsController@store', 'method' => 'POST','enctype' => 'multipart/form-data']) }}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('visible', 'Visible')}}
            {{Form::checkbox('visible', 'visible', true)}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection