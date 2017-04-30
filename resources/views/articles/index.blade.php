@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @yield('css')
@stop
@section('body_class', 'layout-top-nav skin-blue')
@section('css')
    <link rel="stylesheet" href="/css/application.css">
@endsection

@section('body')
    <div>
        @include('layouts._header')
        @include('layouts._nav')
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
@stop