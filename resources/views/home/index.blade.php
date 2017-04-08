@extends('layouts.simple')

@section('content')
    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-8">
                @include('articles._article_list')
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        用户一览
                    </div>
                    <div class="card-block">
                        @foreach($users as $user)
                            <div class="col-xs-3 text-xs-center">
                                <a href="{{ url('/users/'.$user->id.'/articles') }}">
                                    <img src="{{ url($user->logo) }}" alt="" class="img-circle" width="40px" height="40px" />
                                </a>
                                <p>{{ $user->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item active">平台统计</li>
                    <li class="list-group-item">用户量：{{ App\User::count() }}</li>
                    <li class="list-group-item">文章数：{{ App\Article::count() }}</li>
                    <li class="list-group-item">评论数：{{ App\Comment::count() }}</li>
                </ul>
            </div>

        </div>
    </div>

@endsection