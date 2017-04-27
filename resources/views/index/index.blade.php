@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop
@section('body_class', 'layout-top-nav skin-blue')

@section('body')
    <div>
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand"><b>VVB</b>log</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-collapse">



                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <section class="content-wrapper">
            <div class="container" style="padding-top: 20px">
                <div class="row" style="border-bottom:1px dashed  #7A8B8B;padding-bottom: 10px">
                    <div class="col-md-6 text-center">
                        <i class="fa fa-globe" style="font-size: 20em" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-6">
                        <h1 style="margin-top: 1em">个人名片，随时分享</h1>
                        <ul>
                            <li>分享二维码</li>
                            <li>分享到QQ、微信、微博</li>
                        </ul>

                    </div>


                </div>

                <div class="row" style="border-bottom:1px dashed  #7A8B8B;padding-bottom: 10px">
                    <div class="col-md-6 text-center">
                        <i class="fa fa-camera-retro" style="font-size: 20em" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-6">
                        <h1 style="margin-top: 1em">记录生活的点点滴滴</h1>
                        <blockquote>
                            <p>真实的创作灵感，只能来源于现实生活</p>
                            <footer>引用于 <cite title="邓拓">邓拓</cite></footer>
                        </blockquote>
                        <blockquote>
                            <p>作品是心灵的精华</p>
                            <footer>引用于 <cite title="邓拓">叔本华</cite></footer>
                        </blockquote>
                    </div>
                </div>

                <div class="row" style="'border-bottom:1px dashed #7A8B8B;padding-bottom:10px">
                    <h1 class="text-center">热门用户</h1>
                    @foreach($users as $user)
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-aqua-active text-center">
                                <h4 class="widget-user-username">{{ $user->name }}</h4>
                                <h5 class="widget-user-desc">
                                    @foreach($user->professions as $profession)
                                        <span class="label label-primary">{{ $profession->name }}</span>
                                    @endforeach
                                </h5>
                            </div>
                            <div class="widget-user-image">
                                <a href="{{ url()->route('users.articles.index',$user->id) }}">
                                    <img src="{{ $user->logo }}" alt="" class="img-circle" width="90px" height="90px">
                                </a>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $user->articles()->count() }}</h5>
                                            <span class="description-text">Articles</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $user->comments()->count() }}</h5>
                                            <span class="description-text">Comments</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $user->collected_articles()->count() }}</h5>
                                            <span class="description-text">Collects</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    @endforeach

                </div>

            </div>
            <footer class="bg-blue-gradient">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="margin:20px auto">
                                copyright@2016 cherokee. All rights reserved.
                                <span class="pull-right">power by &nbsp;&nbsp;<a href="https://laravel.com" class="text-black">laravel</a></span>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </section>

    </div>
@stop