@extends('adminlte::page')

@section('title', 'vvblog')

@section('content_header')
    <h1>欢迎{{ Auth::user()->name  }} </h1>
@stop
@push('scripts')
<script src="/js/application.js"></script>
@endpush
@section('content')
        <br>

        <p id="category-conf">菜单配置 <i class="fa fa-plus-circle" aria-hidden="true"></i></p>

        <fieldset class="form-inline">
            <div class="form-group">
                <div class="input-group">
                    {{ Form::text('category',null,['class'=>'form-control','placeholder'=>'添加主菜单']) }}
                    <div class="input-group-addon"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>

                </div>
            </div>
            <button class="btn btn-primary" id="add-category">添加主菜单</button><span class="text-danger"></span>
        </fieldset>

        <ul id="category_list">


            @foreach(Auth::user()->categories as $category)
                <hr>
                <li data-category-id="{{ $category->id }}">
                    {{ $category->name }}
                    <span class="delete-category-btn"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <fieldset class="form-inline">
                        <div class="form-group">
                            <div class="input-group">
                                {{ Form::text('category',null,['class'=>'form-control','placeholder'=>'添加子菜单','required'=>'required']) }}
                                <div class="input-group-addon"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>

                            </div>
                        </div>
                        <button class="btn btn-info child-category-btn">添加子菜单</button>
                        <span class="text-danger"></span>
                    </fieldset>
                    <ul >

                        @foreach($category->childCategories as $child_category)
                            <li data-child-category-id="{{ $child_category->id }}">
                                {{ $child_category->name }} <span class="delete-child-category-btn"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </li>
                        @endforeach

                    </ul>
                </li>


            @endforeach
        </ul>

@stop