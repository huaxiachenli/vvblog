@extends('layouts.simple')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">发表文章</h3>
                {{ Form::model($article,['route'=>['articles.update',21,$article->id],'method'=>'put']) }}
                @include('articles._form')
                {{ Form::close() }}
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
    @endpush
    @push('styles')
    <link rel="stylesheet" href="/css/bootstrap-markdown.min.css">
    @endpush
@endsection
