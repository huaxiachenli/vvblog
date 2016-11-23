@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-xs-center">一级菜单</h1>
                <hr>
                <ul>
                    @foreach($categories as $category)
                        <li>{{ $category->name }}</li>

                            <ul>

                                @foreach( $category->childCategories  as $child_category)
                                    <li>
                                        {{ $child_category->name }}
                                    </li>
                                @endforeach

                            </ul>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection