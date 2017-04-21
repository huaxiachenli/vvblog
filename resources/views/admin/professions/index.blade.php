@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    <h1>欢迎{{ Auth::user()->name  }} </h1>
@stop
@push('scripts')
    <script src="/js/application.js"></script>
@endpush
@section('content')
    <h3>职业</h3>
    <hr>
    <div class="col-md-offset-2 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">职业范围</h3>
                <field class="form-inline pull-right" id="addProfession">
                    <div class="form-group">
                        {{ Form::text('name',null,['class'=>'form-control','required'=>'required','placeholder'=>'添加职业']) }}
                        <button class="btn btn-primary">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                    <span class="text-danger"></span>
                </field>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-condensed" id="profession-table">
                    <tbody>
                    <tr>
                        <th>序号</th>
                        <th>名称</th>
                        <th>操作</th>
                    </tr>
                    @foreach(Auth::user()->professions as $profession)
                    <tr data-profession-id="{{ $profession->id }}">
                        <td>{{ $loop->iteration	 }}</td>
                        <td>{{ $profession->name }}</td>
                        <td>
                            <button class="btn btn-danger" data-profession-id="{{ $profession->id }}">删除</button>
                        </td>
                    </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
        <hr>
@stop