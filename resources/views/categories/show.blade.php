@extends('layouts.app')
@section('_header')
    @include('layouts._header')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ url()->route('articles.index',$user->id) }}">{{ $user->name }}</a>
                    <span class="breadcrumb-item active">{{ $category->name }}</span>
                </nav>
            </div>
            <div class="col-md-8">
              @include('articles._article_list')

            </div>
            <div class="col-md-4">

                @include('shares._title')

                @include('shares._newest')

                @include('shares._tagCloud')

            </div>

        </div>
    </div>

@endsection