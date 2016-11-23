<div class="card">
    <h6 class="card-header"><i class="fa fa-book" aria-hidden="true"></i> 最新文章</h6>
    <ul class="list-group list-group-flush">
        @foreach($user->articles()->orderBy('created_at','desc')->take(5)->get() as $newArticle)
            <li class="list-group-item">
                <a href="{{ url()->route('articles.show',['user_id'=>$user->id,'article_id'=>$newArticle->id]) }}" class="card-link">
                    {{ $newArticle->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>