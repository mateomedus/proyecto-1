@extends('layouts.app')

@section('content')
<h1>Edit Profile</h1>
{{Form::open(['action' => 'ProfileController@update', 'method' => 'POST','enctype' => 'multipart/form-data'])}}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $profile->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>
    <div class="form-group">
            {{Form::label('username', 'Username')}}
            {{Form::text('username', $profile->username, ['class' => 'form-control', 'placeholder' => 'Username'])}}
        </div>
        <div>
            {{ Form::label('password', 'Password', ['class' => $errors->has('password') ? 'error' : ''])}}
            {{ Form::password('password', ['class' => 'form-control',$errors->has('password') ? 'error' : '']) }}
            @if ($errors->has('password'))
                <small class="error">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <br>
        <div>
            {{ Form::label('password_confirmation', 'Confirm password', ['class' => $errors->has('password_confirmation') ? 'error' : '']) }}
            {{ Form::password('password_confirmation', ['class' => 'form-control',$errors->has('password_confirmation') ? 'error' : '']) }}
            @if ($errors->has('password_confirmation'))
                <small class="error">{{ $errors->first('password_confirmation') }}</small>
            @endif
        </div>
        <br>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{{Form::close()}}

@endsection