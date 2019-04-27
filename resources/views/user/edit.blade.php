@extends('layouts.app')

@section('content')
<h1>Edit Profile</h1>
{{Form::open(['action' => 'ProfileController@update', 'method' => 'POST','enctype' => 'multipart/form-data'])}}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $profile->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', $profile->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{{Form::close()}}

@endsection