@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create/{{$list_id}}" class="btn btn-primary"> Create Post </a>
                    <br><br>
                    <h3>Your blog posts from list {{$list->title}}</h3>
                    @if(count($posts)>0)
                        <table class="table table-striped">
                            <tr>
                                <th> Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default"> Edit</a></td>
                                    <td><a href="/posts/{{$post->id}}/delete" class="btn btn-danger"> Delete</a></td>
                                </tr>
                            @endforeach
                        </table>
                    @else <p> You have no posts</p>
                    @endif
                </div>
            </div>
            <br>
            <a href="/listDashboard" class="btn btn-primary">Go back</a>
        </div>
    </div>
</div>
@endsection
