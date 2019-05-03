@extends('layouts.app')

@section('content')
    <h1>Lists</h1>
    <hr>
    @if(count($lists) > 0)
        @foreach($lists as $list)
            <div class="well">
                <div class="row bg-white rounded border border-info">
                    <div class="col-md-9 col-sm-9">
                        <h3><a href="/lists/{{$list->id}}">{{$list->title}}</a></h3>
                    </div>
                </div>
                <br>
            </div>
        @endforeach
        {{$lists->links()}}
    @else
        <p>No lists found</p>
    @endif
@endsection