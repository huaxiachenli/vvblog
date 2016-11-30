@extends('layouts.simple')
@section('content')
    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-block">
                        <img src="{{ asset(Auth::user()->logo) }}" alt="">
                        <h3 class="text-xs-center">{{ Auth::user()->name }}</h3>
                        <p class="text-xs-center">
                            @if($professions = Auth::user()->professions)
                                @foreach($professions as $profession)
                                    <span class="tag tag-pill tag-default">{{ $profession->name }}</span>
                                @endforeach
                            @else
                                <span class="tag tag-pill tag-default">文字爱好者</span>
                            @endif

                            {{--<span class="tag tag-pill tag-default">ruby工程师</span>--}}
                        </p>
                        <p>
                            <a href="{{ url()->route('articles.create',Auth::user()->id) }}" class="btn btn-block btn-outline-danger">发表文章</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Nav tabs -->
                <div class="card" id="user-card" data-user-id="{{ Auth::user()->id }}">
                    <div class="card-block">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">主面板</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">个人信息</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#category" role="tab">菜单</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#article-table" role="tab">文章</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#star" role="tab">点赞</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#collects" role="tab">收藏</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profession" role="tab">职业</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#blogProfile" role="tab">profile</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <br>
                                <h3>用户信息</h3>
                                <hr>
                                <p>用户名：{{ Auth::user()->name }}</p>
                                <p>E-Mail:{{ Auth::user()->email }}</p>
                                <p>职业技能：php工程师 & ruby工程师 </p>
                                <p>发表文章总数：{{ Auth::user()->articles->count() }}</p>
                                <p> 发表评论总数：{{ Auth::user()->comments->count() }}</p>

                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <br>
                                <h3>修改个人信息</h3>
                                {{ Form::open(['url'=>'#']) }}
                                <fieldset class="form-group">
                                    {{ Form::label('name','用户名') }}
                                    {{ Form::text('name',Auth::user()->name,['class'=>'form-control']) }}
                                </fieldset>
                                <fieldset class="form-group">
                                    {{ Form::label('email','邮 箱') }}
                                    {{ Form::text('email',Auth::user()->email,['class'=>'form-control']) }}
                                </fieldset>
                                <fieldset class="form-group">
                                    {{ Form::label('logo','LOGO') }}
                                    {{ Form::file('logo',['class'=>'form-control-file']) }}
                                </fieldset>
                                <fieldset class="form-group">
                                    {{ Form::submit('更新',['class'=>'btn btn-primary btn-block']) }}
                                </fieldset>


                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane" id="category" role="tabpanel">
                                <br>
                               <p id="category-conf">菜单配置 <i class="fa fa-plus-circle" aria-hidden="true"></i></p>

                                <fieldset class="form-inline">
                                    <div class="form-group">
                                        <div class="input-group">
                                            {{ Form::text('category',null,['class'=>'form-control','placeholder'=>'添加主菜单']) }}
                                            <div class="input-group-addon"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>

                                        </div>
                                    </div>
                                    <button class="btn btn-primary" id="add-category">添加主菜单</button>
                                </fieldset>

                                <p>
                                <ul id="category_list">

                                    @foreach($user->categories as $category)
                                        <hr>
                                       <li data-category-id="{{ $category->id }}">
                                           {{ $category->name }} <span onclick="deleteCate()"><i class="fa fa-times" aria-hidden="true"></i></span>
                                           <fieldset class="form-inline">
                                               <div class="form-group">
                                                   <div class="input-group">
                                                       {{ Form::text('category',null,['class'=>'form-control','placeholder'=>'添加子菜单','required'=>'required']) }}
                                                       <div class="input-group-addon"><i class="fa fa-check-square-o" aria-hidden="true"></i></div>

                                                   </div>
                                               </div>
                                               <button class="btn btn-info child-cate-btn" onclick="addChildCate($(this))">添加子菜单</button>
                                           </fieldset>
                                           <ul >

                                               @foreach($category->childCategories as $child_category)
                                               <li class="child-cate-list" data-child-category-id="{{ $child_category->id }}">
                                                   {{ $child_category->name }} <span><i class="fa fa-times" aria-hidden="true"></i></span>
                                               </li>
                                                @endforeach

                                           </ul>
                                       </li>


                                    @endforeach
                                </ul>
                                </p>
                            </div>
                            <div class="tab-pane" id="article-table" role="tabpanel">
                                <br>
                                <ul class="list-group">
                                    @foreach(Auth::user()->articles as $article)
                                    <li class="list-group-item" data-article-id="{{ $article->id }}">
                                        <a href="{{ url()->route('articles.show',['user_id'=>$article->user_id,'article_id'=>$article->id]) }}" class="card-link">
                                            {{ $article->title }}
                                        </a>
                                        <span class="float-lg-right">
                                            <a href="{{ url()->route('articles.edit',['user_id'=>Auth::user()->id,'article_id'=>$article->id]) }}" class="btn btn-primary btn-sm">修改</a>
                                            <button class="btn btn-danger btn-sm delete-article">删除</button>
                                        </span>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="tab-pane" id="star" role="tabpanel">
                                <br>
                                <h5>我赞过的文章</h5>
                                <hr>
                                <div class="card">
                                    <ul class="list-group">
                                        @foreach(Auth::user()->liked_articles as $liked_article)
                                            <li class="list-group-item">
                                                <a href="{{ url()->route('articles.show',['user_id'=>$liked_article->user_id,'article_id'=>$liked_article->id]) }}" class="card-link">
                                                    {{ $liked_article->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="collects" role="tabpanel">
                                <br>
                                <h5>收藏的文章</h5>
                                <hr>
                                <div class="card">
                                    <ul class="list-group">
                                        @foreach(Auth::user()->collected_articles as $collected_article)
                                            <li class="list-group-item">
                                                <a href="{{ url()->route('articles.show',['user_id'=>$collected_article->user_id,'article_id'=>$collected_article->id]) }}" class="card-link">
                                                    {{ $collected_article->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="profession" role="tabpanel">
                                <br>
                                <h5>职业</h5>
                                <hr>
                                <div class="card">
                                    <div class="card-block">

                                        <field class="form-inline" id="addProfession">
                                            <div class="form-group">
                                                {{ Form::text('name',null,['class'=>'form-control','required'=>'required','placeholder'=>'添加职业']) }}
                                                <button class="btn btn-outline-primary">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </field>
                                    </div>

                                    <ul class="list-group" id="professionList">

                                        @foreach(Auth::user()->professions as $profession)
                                            <li class="list-group-item" data-profession-id="{{ $profession->id }}">
                                                {{ $profession->name }}  <i class="fa fa-times removeProfession" aria-hidden="true"></i>
                                            </li>
                                        @endforeach    
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="blogProfile" role="tabpanel">
                                <br>
                                <h5>更改博客属性</h5>
                                <hr>

                                <div class="card">
                                    <div class="card-block">
                                        @if($profile = Auth::user()->profile)
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    标题：
                                                    {{ $profile->title }}
                                                </li>
                                                <li class="list-group-item">
                                                    子标题：
                                                    {{ $profile->child_title }}
                                                </li>
                                                <li class="list-group-item">
                                                    博客简介：
                                                    {{ $profile->introduce }}
                                                </li>
                                            </ul>
                                         @else
                                            {{ Form::open(['route'=>['profiles.store',Auth::user()->id]]) }}
                                            <fieldset class="form-group">
                                                {{ Form::label('title','标题') }}
                                                {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'请输入博客标题']) }}
                                            </fieldset>
                                            <fieldset class="form-group">
                                                {{ Form::label('child_title','副标题') }}
                                                {{ Form::text('child_title',null,['class'=>'form-control','placeholder'=>'请输入博客副标题']) }}
                                            </fieldset>
                                            <fieldset class="form-group">
                                                {{ Form::label('introduce','博客简介') }}
                                                {{ Form::text('introduce',null,['class'=>'form-control','placeholder'=>'请输入博客简介']) }}
                                            </fieldset>
                                            <fieldset class="form-group">
                                                {{ Form::submit('配置博客',['class'=>'btn btn-block btn-primary']) }}
                                            </fieldset>

                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection