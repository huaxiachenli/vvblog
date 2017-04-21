@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    <h1>欢迎{{ $user->name  }} </h1>
@stop

@section('content')
    <h3>修改个人信息</h3>
    <hr>
    {{ Form::open(['route'=>['users.update',Auth::user()->id],'files'=>true,'method'=>'put']) }}
    <fieldset class="form-group">
        {{ Form::label('name','用户名') }}
        {{ Form::text('name',Auth::user()->name,['class'=>'form-control']) }}
    </fieldset>
    <fieldset class="form-group">
        {{ Form::label('email','邮 箱') }}
        {{ Form::text('email',Auth::user()->email,['class'=>'form-control']) }}
    </fieldset>
    <fieldset class="form-group">
        {{ Form::label('avatar','Avatar') }}
        {{ Form::file('avatar',['class'=>'form-control-file']) }}
    </fieldset>
    <fieldset class="form-group">
        {{ Form::submit('更新',['class'=>'btn btn-primary btn-block']) }}
    </fieldset>


    {{ Form::close() }}
@stop