@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
        <h1>Welcome To Post-It!</h1>
        <h4>This is here you can post your interests for people to read.</h4>
        <br>
        <h4>Pleass login/register and start creating your posts.</h4>   
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        <br>
        <div class="form-group row">
                <div class="col-md-4 offset-md-4">
                    <a href="login/google">Login with Google</a> 
                </div>
        </div>
    </div>
@endsection