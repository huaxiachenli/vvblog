@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">发表文章</h3>
                {{ Form::model($article,['route'=>['articles.update',21,$article->id],'method'=>'put','files'=>true]) }}
                @include('articles._form')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
