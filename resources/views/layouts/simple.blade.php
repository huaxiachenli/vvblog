<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="baidu-site-verification" content="Xcd93zpIRR" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <link href="/css/app.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">--}}
    {{--<link rel="stylesheet" href="/css/font-awesome.css">--}}
    <link rel="stylesheet" href="/css/application.css">
{{--<link rel="stylesheet" href="http://cdn.bootcss.com/highlight.js/9.8.0/languages/x86asm.min.js">--}}
@stack('styles')
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body>
@yield('_header')
@include('layouts._flash')
    @yield('content')




<!-- Scripts -->
<script src="/js/app.js"></script>
{{--<script src="/js/jquery.min.js"></script>--}}
{{--<script src="http://cdn.bootcss.com/jquery/1.10.0/jquery.min.js"></script>--}}
<script src="/js/application.js"></script>
{{--<script src="/js/bootstrap.min.js"></script>--}}
{{--<script src="http://cdn.bootcss.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>--}}



{{--<script src="/js/app.js"></script>--}}
@stack('scripts')

</body>
</html>
