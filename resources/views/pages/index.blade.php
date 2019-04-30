@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
        <h1>Welcome To Post-It!</h1>
        <p>This is here you can post your interests for people to read.</p>
        <br>
        <p>Pleass login/register and start creating your posts.</p>   
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection