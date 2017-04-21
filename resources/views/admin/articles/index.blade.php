@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
@include('admin.layouts._flash')
@stop
@push('scripts')
<script src="/js/application.js"></script>
@endpush
@section('content')
    <p><a class="btn-success btn btn-lg" href="{{ url('/admin/articles/create') }}">开始写文章</a></p>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">所有文章</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>序号</th>
                            <th>标题</th>
                            <th>操作</th>
                        </tr>
                        @foreach(Auth::user()->articles()->orderBy('id','desc')->get()  as $article )
                        <tr data-article-id="{{ $article->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ url()->route('articles.show',['article_id'=>$article->id]) }}">
                                    {{ $article->title }}
                                </a></td>
                            <td class="text-right">
                               <a class="btn btn-primary" href="{{ url()->route('articles.edit',$article->id) }}">修改</a>
                                <button class="btn btn-danger delete-article-btn">删除</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop