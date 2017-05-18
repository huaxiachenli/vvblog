@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    <h1>欢迎{{ Auth::user()->name  }} </h1>
@stop
@section('js')
    <script src="/js/application.js"></script>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">收藏的文章</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>文章</th>
                    <th>简介</th>
                    <th style="width: 40px">操作</th>
                </tr>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td>
                        {{ $article->intro }}
                    </td>
                    <td><a href="{{ url()->route('users.articles.show',[$article->user_id,$article->id]) }}"><span class="badge bg-green">阅读</span></a></td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop