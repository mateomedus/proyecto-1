@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    <hr>
    <h3>Name: {{$profile->name}}<h3>
    <h3>Username: {{$profile->username}}<h3>
    <h3>Email: {{$profile->email}}<h3>
    <h3>Created: {{$profile->created_at}}<h3>
    @if(!Auth::guest()) 
        @if(Auth::user()->id == $profile->id)
            <a href="/edit" class="btn btn-default"> Edit</a>
        @endif
    @endif
@endsection