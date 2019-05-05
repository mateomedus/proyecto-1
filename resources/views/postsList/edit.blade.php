@extends('layouts.app')

@section('content')
    <h1>Edit List</h1>
    {{ Form::open(['action' => ['ListsController@update', $list->id], 'method' => 'POST','enctype' => 'multipart/form-data']) }}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $list->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
                {{Form::label('visible', 'Visible')}}
                {{Form::select('visible', array('false' => 'Privada', 'true' => 'Publica'), $list->visible, ['class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection