@extends('layouts.app')
@section('_header')
    @include('layouts._header')
@endsection
@section('content')
    <div class="container">
        <div class="col-md-12">

        </div>
        <div class="col-md-8">
            <section id="post-list">
                @foreach($articles as $article)
                    <div>
                        <a href="{{ route('articles.show',[$article->user_id,$article->id]) }}">
                            @if( $article->logo)
                                <img src="{{ asset($article->logo) }}" style="float:left;margin-right: 15px" alt="" width='180px' height="120px">
                            @else
                                <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=57752203,4206309259&fm=80&w=179&h=119&img.JPEG" style="float:left;margin-right: 15px" alt="">
                            @endif
                        </a>
                        <h4>
                            <a href="{{ route('articles.show',[$article->user_id,$article->id]) }}">
                                {{ $article->title }}
                            </a>
                        </h4>
                        <p>
                            {{ $article->intro }}
                        </p>
                        <p>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ $article->created_at }}
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                            <a href="{{ url()->route('categories.show',[$user->id,$article->category->id]) }}">{{ $article->category->name }}</a> • <a href="{{ url()->route('child_categories.show',[$user->id,$article->ChildCategory->id]) }}">{{ $article->ChildCategory->name }}</a>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            @foreach($article->tags as $tag)
                                <label for="label" class="tag {{ array_rand(['tag-default'=>0,'tag-primary'=>1,'tag-info'=>2,'tag-success'=>3,'tag-danger'=>4]) }}">{{ $tag->name }}</label>
                            @endforeach
                        </p>
                    </div>
                @endforeach
            </section>
        </div>
        <div class="col-md-4">
            @include('shares._title')
            @include('shares._newest')
            @include('shares._tagCloud')
        </div>
    </div>

@endsection