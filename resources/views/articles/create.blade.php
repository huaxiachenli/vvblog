@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h3 class="text-xs-center">发表文章</h3>
                {!! Form::open(['route'=>['articles.store',Auth::user()->id],'files'=>true]) !!}
                    @include('articles._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
