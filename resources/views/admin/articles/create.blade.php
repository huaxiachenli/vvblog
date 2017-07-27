

@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    {{--@include('editor::head')--}}
    <h1>欢迎{{ Auth::user()->name  }} </h1>
@stop

@section('content')
    <h1 class="text-center">开始写文章</h1>
    <hr>
    {!! Form::open(['route'=>['articles.store',Auth::user()->id],'files'=>true]) !!}
    {{--// 引入编辑器代码--}}
    <fieldset class="form-group">
        {{ Form::label('title','标题') }}
        {{ Form::text('title',null,['class'=>'form-control','reuquired'=>'required','placeholder'=>'请输入标题']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('intro','简介') }}
        {{ Form::text('intro',null,['class'=>'form-control','placeholder'=>'本文简介信息（30字左右）','required'=>'required']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('content','内容') }}
        {{--{{ Form::textarea('content',null,["data-provide"=>"markdown","data-iconlibrary"=>"fa",'id'=>'markdown','required'=>'required','placeholder'=>'支持markdown语法']) }}--}}
        {{--// 编辑器一定要被一个 class 为 editor 的容器包住--}}
        <div class="editor">
            {{--// 创建一个 textarea 而已，具体的看手册，主要在于它的 id 为 myEditor--}}
            {!! Form::textarea('content', '', ['class' => 'form-control','id'=>'myEditor']) !!}

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
        {{ Form::select('tag[]',Auth::user()->tags->pluck('name','name'),null,['class'=>'form-control','id'=>'tag','required'=>'required','multiple']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::label('child_category_id','分类') }}
        {{ Form::select('child_category_id',Auth::user()->child_categories()->pluck('name','id'), null, ['placeholder' => '请选择分类','class'=>'form-control','required'=>'required']) }}
    </fieldset>

    <fieldset class="form-group">
        {{ Form::submit('提交',['class'=>'btn btn-block btn-primary' ]) }}
    </fieldset>
   
    {!! Form::close() !!}

@stop

 @section('css')
    <link href="https://cdn.bootcss.com/select2/4.0.3/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/highlight.js/8.4/styles/default.min.css">
        <link rel="stylesheet" href="{{ asset('plugin/editor/css/pygment_trac.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/editor/css/editor.css') }}">
    <style>
        .editor{
            width:{{ config('editor.width') }};
        }
    </style>
    @endsection
    @section('js')
    <script src="https://cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('#tag').select2({tags:true});
    </script>
    <script src="https://cdn.bootcss.com/highlight.js/9.12.0/highlight.min.js"></script>
    <script src="https://cdn.bootcss.com/marked/0.3.2/marked.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/codemirror/4.10.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/highlight.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/MIDI.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/fileupload.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/bacheditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugin/editor/js/bootstrap3-typeahead.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            url = "{{ url(config('editor.uploadUrl')) }}";

            @if(config('editor.ajaxTopicSearchUrl',null))
                    ajaxTopicSearchUrl = "{{ url(config('editor.ajaxTopicSearchUrl')) }}";
            @else
                    ajaxTopicSearchUrl = null;
                    @endif

            var myEditor = new Editor(url,ajaxTopicSearchUrl);
            myEditor.render('#myEditor');
        });
    </script>
    @endsection
