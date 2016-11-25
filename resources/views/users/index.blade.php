@extends('layouts.simple')
@section('content')

    <div class="container">
        <div class="row">
            @foreach($users as $user)
                <div class="col-xs-3 text-xs-center">
                    <a href="{{ url('/users/'.$user->id.'/articles') }}">
                        <img src="{{ url($user->logo) }}" alt="" class="img-circle" width="200px" height="200px">
                    </a>
                    <h5>{{ $user->name }}</h5>
                    <p><span class="tag tag-default">php</span> <span class="tag tag-default">ruby</span></p>
                </div>
            @endforeach
        </div>
    </div>
@endsection