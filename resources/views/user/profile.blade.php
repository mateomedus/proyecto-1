@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    <h3>Profile name: {{$profile->name}}<h3>
    <h3>Email: {{$profile->email}}<h3>
    @if(!Auth::guest()) 
        @if(Auth::user()->id == $profile->id)
            <a href="/edit" class="btn btn-default"> Edit</a>
        @endif
    @endif
@endsection