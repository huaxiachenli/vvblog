<div class="card">
    <h6 class="card-header">
        <i class="fa fa-heart" aria-hidden="true"></i> 猜你感兴趣
    </h6>
    <ul class="list-group list-group-flush">
        @foreach($article->childCategory->articles as $childCategoryArticle)
            <li class="list-group-item">
                <a href="{{ url()->route('articles.show',['user_id'=>$user->id,'article_id'=>$article->id]) }}" class="card-link">
                    {{ $childCategoryArticle->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>