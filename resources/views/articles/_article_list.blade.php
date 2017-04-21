<section id="post-list">
   @foreach($articles as $article)
    <div style="padding-bottom: 25px">
            <a href="{{ route('users.articles.show',[$article->user_id,$article->id]) }}">
                @if( $article->logo)
                    <img src="{{ asset($article->logo) }}" style="float:left;margin-right: 15px" alt="" width='180px' height="120px">
                @else
                    <img src="https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=57752203,4206309259&fm=80&w=179&h=119&img.JPEG" style="float:left;margin-right: 15px" alt="">
                @endif
            </a>
            <h4>
                <a href="{{ route('users.articles.show',[$article->user_id,$article->id]) }}">
                    {{ $article->title }}
                </a>
            </h4>
            <p>
                {{ $article->intro }}
            </p>
        <p>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            {{ $article->created_at }}
            <i class="fa fa-th-list" aria-hidden="true"></i>
            <a href="{{ url()->route('users.categories.show',[$article->user_id,$article->category->id]) }}">{{ $article->category->name }}</a> • <a href="{{ url()->route('users.child_categories.show',[$article->user_id,$article->ChildCategory->id]) }}">{{ $article->ChildCategory->name }}</a>
            <i class="fa fa-tags" aria-hidden="true"></i>
            @foreach($article->tags as $tag)
                <a href="{{ url()->route('tag',[$article->user_id,$tag->name]) }}" class="tag-link">
                    <label for="label" class="label {{ array_rand(['label-default'=>0,'label-primary'=>1,'label-info'=>2,'label-success'=>3,'label-danger'=>4]) }}">{{ $tag->name }}</label>
                </a>
            @endforeach
        </p>
    </div>
   @endforeach
    <div class="text-center">{{ $articles->links() }}</div>
</section>