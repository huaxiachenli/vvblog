@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    <h1>欢迎{{ $user->name }}</h1>
    @include('admin.layouts._flash')
@stop

@section('content')
    <hr>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ Auth::user()->articles()->count()}}</h3>

                    <p>Articles</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="{{ url()->route('users.articles.index',[Auth::user()->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ Auth::user()->comments()->count() }}</h3>

                    <p>Comments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ \App\User::count() }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ Auth::user()->collected_articles()->count() }}</h3>

                    <p>Collects</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="/admin/collect" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <p>
        用户名：{{ $user->name }}

    </p>
    <p>
        E-Mail:{{ $user->email }}

    </p>
    <p>
        职业技能：
        @foreach($user->professions as $profession)
            <i class="fa fa-diamond" aria-hidden="true" style="color:red"></i> {{ $profession->name }}
        @endforeach
    </p>
    <p>
        发表文章数：{{ count($user->articles) }}

    </p>
    <p>
        发表评论数：{{ count($user->comments) }}
    </p>
    <a class="btn btn-success" href="{{ url()->route('users.articles.index',[Auth::user()->id]) }}">回到首页</a>
@stop