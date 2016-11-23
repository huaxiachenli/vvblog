@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <h3 class="text-xs-center">发表文章</h3>
                {!! Form::open(['route'=>['articles.store',Auth::user()->id],'files'=>true]) !!}
                    @include('articles._form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="/js/markdown.js"></script>
    <script src="/js/to-markdown.min.js"></script>
    <script src="/js/bootstrap-markdown.js"></script>
    <script src="/js/bootstrap-markdown.zh.js"></script>
    <script>

        $('#markdown').markdown({
            iconlibrary:'fa',
            language:'zh',
        });
    </script>
    <script src="/js/jquery.caret.min.js"></script>
    <script src="/js/jquery.tag-editor.min.js"></script>
    <script>
        $('#tag').tagEditor({'maxTags':4});
    </script>
    @endpush
    @push('styles')
    <link rel="stylesheet" href="/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" href="/css/jquery.tag-editor.css">
    @endpush
@endsection
