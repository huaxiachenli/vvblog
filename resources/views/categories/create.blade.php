@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-xs-center">添加分类</h1>
                {{ Form::open(['route'=>['categories.store',Auth::user()->id]]) }}
                <fieldset class="form-group">
                    {{ Form::label('name','分类名称') }}
                    {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'请输入分类名称']) }}
                </fieldset>

                <fieldset class="form-group">
                    {{ Form::label('parent_id','挂载父级分类节点') }}
                    {{ Form::select('parent_id',array_add(Auth::user()->categories()->pluck('name','id'),0,'一级分类')->all(),null,['placeholder'=>'父级分类','class'=>'form-control','required'=>'required']) }}
                </fieldset>

                <fieldset class="form-group">
                    {{ Form::submit('提交',['class'=>'btn btn-outline-info btn-block']) }}
                </fieldset>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection