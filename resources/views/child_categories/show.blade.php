@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop
@section('body_class', 'layout-top-nav skin-blue')
@push('styles')
<link rel="stylesheet" href="/css/application.css">
@endpush

@section('body')
    <div>
        @include('layouts._header')
        @include('layouts._nav')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb" style="margin: 20px 0">
                        <li><a href="{{ url()->route('users.articles.index',['user_id'=>$user->id]) }}">首页</a></li>
                        <li><a href="{{ url()->route('users.categories.show',[$user->id,$child_category->category->id]) }}">{{ $child_category->category->name }}</a></li>
                        <li><a href="{{ url()->route('users.child_categories.show',[$user->id,$child_category->id]) }}">{{ $child_category->name }}</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @include('articles._article_list')
                </div>
                <div class="col-md-4">
                    @include('shares._newest')
                    @include('shares._tagCloud')
                </div>
            </div>
        </div>

    </div>