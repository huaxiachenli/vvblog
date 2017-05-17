
@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    {{--@include('editor::head')--}}
    <h1>欢迎{{ Auth::user()->name  }} </h1>
@stop

@section('content')
    <h1 class="text-center">修改文章</h1>
    <hr>
    {!! Form::model($article,['route'=>['articles.update',$article->id],'method'=>'put','files'=>true]) !!}
    {{--// 引入编辑器代码--}}
    @include('editor::head')
    <fieldset class="form-group">
        {{ Form::label('title','标题') }}
        {{ Form::text('title',$article->title,['class'=>'form-control','reuquired'=>'required','placeholder'=>'请输入标题']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('intro','简介') }}
        {{ Form::text('intro',$article->intro,['class'=>'form-control','placeholder'=>'本文简介信息（30字左右）','required'=>'required']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('content','内容') }}
        {{--{{ Form::textarea('content',null,["data-provide"=>"markdown","data-iconlibrary"=>"fa",'id'=>'markdown','required'=>'required','placeholder'=>'支持markdown语法']) }}--}}
        {{--// 编辑器一定要被一个 class 为 editor 的容器包住--}}
        <div class="editor">
            {{--// 创建一个 textarea 而已，具体的看手册，主要在于它的 id 为 myEditor--}}
            {!! Form::textarea('content', $article->content, ['class' => 'form-control','id'=>'myEditor']) !!}

            {{--// 上面的 Form::textarea ，在laravel 5 中被提了出去，如果你没安装的话，直接这样用--}}

            {{--// 主要还是在容器的 ID 为 myEditor 就行--}}

        </div>
    </fieldset>



    <fieldset class="form-group">
        {{ Form::label('logo','LOGO') }}
        {{ Form::file('logo',['class'=>'form-control-file']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('tag','标签') }}
        {{ Form::select('tag_list[]',Auth::user()->tags->pluck('name','name'),$article->tag_list,['class'=>'form-control','id'=>'tag','required'=>'required','multiple']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('child_category_id','分类') }}
        {{ Form::select('child_category_id',Auth::user()->child_categories()->pluck('name','id'), null, ['placeholder' => '请选择分类','class'=>'form-control','required'=>'required']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::submit('提交',['class'=>'btn btn-block btn-primary' ]) }}
    </fieldset>
    @section('css')
    <link href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    @endsection
    @section('js')
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#tag').select2({tags:true});
    </script>
    @endsection
    {!! Form::close() !!}

@stop