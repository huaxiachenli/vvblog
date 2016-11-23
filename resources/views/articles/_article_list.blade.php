<div>
    <a href="{{ route('articles.show',[$article->user_id,$article->id]) }}">
        @if($hasLogo = $article->pictures->where('field','logo')->first())
            <img src="{{ asset($hasLogo->url) }}" style="float:left;margin-right: 15px" alt="" width='200px' height="120px">
        @else
           <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=57752203,4206309259&fm=80&w=179&h=119&img.JPEG" style="float:left;margin-right: 15px" alt="">
        @endif
    </a>
    <h4>
        <a href="{{ route('articles.show',[$article->user_id,$article->id]) }}">
            {{ $article->title }}
        </a>
    </h4>
    <p>
        aaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb{{ $article->intro }}
    </p>
    <p>
        <i class="fa fa-calendar" aria-hidden="true"></i>
        {{ $article->created_at }}
        <i class="fa fa-th-list" aria-hidden="true"></i>
        <a href="{{ url()->route('categories.show',[$user->id,$article->category->id]) }}">{{ $article->category->name }}</a>
        <i class="fa fa-tags" aria-hidden="true"></i>
        @foreach($article->tags as $tag)
            <label for="label" class="tag {{ array_rand(['tag-default'=>0,'tag-primary'=>1,'tag-info'=>2,'tag-success'=>3,'tag-danger'=>4]) }}">{{ $tag->name }}</label>
        @endforeach
    </p>
</div>