@extends('layouts.app')

@section('content')
    <h1>Profile</h1>
    <h3>Profile name: {{$profile->name}}<h3>
    <h3>Email: {{$profile->email}}<h3>
    <a href="/edit" class="btn btn-default"> Edit</a>
@endsection