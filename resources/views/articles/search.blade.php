@extends('layouts.app')
@section('_header')
    @include('layouts._header')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <section id="post-list">
                    @foreach($articles as $article)
                        @include('articles._article_list')
                    @endforeach
                </section>
            </div>
            <div class="col-md-4">
                @include('shares._title')
                @include('shares._newest')
                @include('shares._tagCloud')

            </div>

        </div>
    </div>

@endsection