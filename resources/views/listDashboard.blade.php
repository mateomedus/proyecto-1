@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/postsList/create" class="btn btn-primary"> Create List </a>
                    <br><br>
                    <h3>Your lists</h3>
                    @if(count($lists)>0)
                        <table class="table table-striped">
                            <tr>
                                <th> Title</th>
                                <th>Visibility</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($lists as $list)
                                <tr>
                                    <td><a href="/postDashboard/{{$list->id}}" class="btn btn-default"> {{$list->title}}</a></td>
                                    <td>
                                        @if($list->visible)
                                            Public
                                        @else Private
                                        @endif
                                    </td>
                                    <td><a href="/postsList/{{$list->id}}/edit" class="btn btn-default"> Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['ListsController@destroy', $list->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else <p> You have no lists</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection