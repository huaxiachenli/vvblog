@if($article->childCategory->articles->count()>2)
    <div class="list-group">
        <a href="" class="list-group-item active">
            <i class="fa fa-heart" aria-hidden="true"></i> 猜你感兴趣
        </a>
        @foreach($article->childCategory->articles as $childCategoryArticle)
          @unless($childCategoryArticle->id==$article->id)
            <a href="{{ url()->route('users.articles.show',[$childCategoryArticle->user_id,$childCategoryArticle->id]) }}" class="list-group-item">{{ $childCategoryArticle->title }}</a>
           @endunless
        @endforeach
    </div>
@endif