@extends('adminlte::master')


@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    <link href="https://cdn.bootcss.com/bootstrap-markdown/2.10.0/css/bootstrap-markdown.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/application.css">
@endsection

@section('body_class', 'layout-top-nav skin-blue')
@section('adminlte_js')
    {{--<script src="/js/markdown.js"></script>--}}
    <script src="https://cdn.bootcss.com/markdown.js/0.5.0/markdown.min.js"></script>
    {{--<script src="/js/to-markdown.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/to-markdown/3.0.4/to-markdown.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-markdown/2.10.0/js/bootstrap-markdown.min.js"></script>
    <script src="/js/bootstrap-markdown.zh.js"></script>
    <script>

        $('#markdown').markdown({
            iconlibrary:'fa',
            language:'zh',

        });
    </script>
    <script src="/js/jquery.hotkeys.js"></script>
    <script src="https://cdn.bootcss.com/highlight.js/9.8.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
<script src="/js/application.js"></script>
@endsection

@section('body')
    @include('layouts._header')
    @include('layouts._nav')
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <ol class="breadcrumb" style="margin: 20px 0">
                   <li><a href="{{ url()->route('users.articles.index',$user->id) }}">{{ $user->name }}</a></li>
                   <li><a href="{{ url()->route('users.categories.show',[$user->id,$article->category->id]) }}">{{ $article->category->name }}</a></li>
                   <li><a href="{{ url()->route('users.child_categories.show',[$user->id,$article->childCategory->id]) }}">{{ $article->childCategory->name }}</a></li>
                    <li class="active">{{ $article->title }}</li>
               </ol>
           </div>
           <article class="col-md-8">
               <div id="article" data-article-id="{{ $article->id }}"  data-user-id="{{ $article->user_id }}">
                   <h2>
                       {{ $article->title }}
                   </h2>
                   <p class="text-center">
                       <span>发布时间:{{ $article->created_at->toDateString() }}</span> <span>浏览量:{{ $article->view_count }}</span> <span>作者:{{$article->user->name}}</span>
                       <span>标签：
                            @foreach($article->tags as $tag)
                                <i class="label label-default">{{ $tag->name }}</i>
                            @endforeach
                       </span>
                   </p>
                   <div>
                       {!! $article->parseContent !!}
                   </div>
                   <div class="text-center">
                        {!! QrCode::size(300)->generate(Request::url()); !!}
                        <div class="text-info"><i class="fa fa-mobile" aria-hidden="true"></i> 手机查看</div>
                    </div>
               </div>


               <hr>
               <div id="commentList">
                   @foreach($article->comments as $comment)
                        @include('articles.commentList')
                   @endforeach
               </div>
               @if(Auth::check())

               <div class="media">
                   <a class="media-left" href="{{ url()->route('articles.index',$user->id) }}" title="{{ Auth::user()->name }}">
                       <img class="media-object" id="imgUrl" src="{{ asset(Auth::user()->logo) }}" alt="{{ Auth::user()->name }}" width="60" height="60">
                   </a>
                   <div class="media-body">
                       <h6 class="media-heading" id="userName">{{ Auth::user()->name }}</h6>
                       <div id="commentForm" data-parent-id=0 >
                           {{ Form::hidden('parent_id',0) }}
                           <fieldset class="form-group">
                               {{ Form::textarea('content',null,["data-provide"=>"markdown","data-iconlibrary"=>"fa",'id'=>'markdown' ,'required'=>'required']) }}
                           </fieldset>
                           <p ><i class="fa fa-info-circle" aria-hidden="true"></i><span class="text-muted" >支持ctrl+return一键回复(mac OS为command+return回复）</span></p>

                           <fieldset class="form-group">
                               {{ Form::submit('提交',['class'=>'btn btn-primary btn-block','id'=>'commentBtn']) }}
                           </fieldset>
                       </div>
                   </div>
               </div>
               @else
                   <p class="text-center">
                       <a href="/login?redirect_url={{ url()->current() }}" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> 登录后评论</a>
                   </p>

               @endif

           </article>
           <aside class="col-md-4">
               <div class="panel panel-default" id="favorite">
                   <div class="panel-body text-center">
                       <h4>点赞啦!!</h4>
                       @if(Auth::check())
                           @if($likeable = Auth::user()->likeable($article->id))
                                   <i class="fa fa-heart fa-5x" data-likeable-id="{{ $likeable->id }}" id="likeable" aria-hidden="true"></i>
                           @else
                                   <i class="fa fa-heart-o fa-5x" data-likeable-id="{{ $likeable }}" id="likeable" aria-hidden="true"></i>
                           @endif
                       @else
                           <a href="/login?redirect_url={{ url()->current() }}">
                               <i class="fa fa-heartbeat fa-5x"  aria-hidden="true"></i>
                           </a>
                       @endif
                       <p class="text-muted">共收到<span id="likeCount">{{ $article->likeables()->count() }}</span>个赞</p>
                       <hr>
                       <div class="btn-group" role="group" aria-label="Third group">
                           <button type="button" id="support" class="btn btn-default"><i class="fa fa-2x fa-thumbs-o-up" aria-hidden="true"></i></button>
                           <button type="button" id='unsupport' class="btn btn-default"><i class="fa fa-2x fa-thumbs-o-down" aria-hidden="true"></i></button>

                       </div>
                       <p class="text-muted">被支持<span id="supportCount">{{ $article->suport_count }}</span>次•被踩了<span id="unsupportCount">{{ $article->reject_count }}</span>次</p>
                       <hr>
                       <p class="text-center">
                           @if(Auth::check())

                               @if($collect = Auth::user()->collected($article->id))
                                   <button class="btn btn-danger" data-collect-id="{{ $collect->id }}" id="collect"><i class="fa fa-star-o" aria-hidden="true"></i><span> 已收藏</span> </button>
                                @else
                               {{--<a href="/collects" class="btn btn-outline-danger" id="collect"><i class="fa fa-star-o" aria-hidden="true"></i><span>收藏</span></a>--}}
                                   <button class="btn btn-default" data-collect-id='0' id="collect"><i class="fa fa-star-o" aria-hidden="true"></i><span> 收藏</span> </button>
                                @endif
                            @else
                               <a href="/login?redirect_url={{ url()->current() }}" class="btn btn-primary">登录后再收藏</a>
                            @endif

                       </p>
                       <hr>
                       <p class="text-center">
                       <div class="bdsharebuttonbox "><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>

                       </p>
                   </div>
               </div>
              @include('shares._interest')
               <div class="list-group">
                   <a href="#" class="list-group-item active">
                       <i class="fa fa-user" aria-hidden="true"></i> 作者其他类似文章
                   </a>
                   @foreach($article->category->articles as $userArticle)
                       @unless($userArticle==$article)
                           <a href="{{ url()->route('users.articles.show',[$userArticle->user_id,$userArticle->id]) }}" class="list-group-item">
                               {{ $userArticle->title }}
                               <span class=" pull-right"><i class="fa fa-eye" aria-hidden="true"></i> {{ $userArticle->view_count }} </span>
                           </a>
                       @endunless
                   @endforeach
               </div>
           </aside>
       </div>
   </div>



   <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
@endsection
