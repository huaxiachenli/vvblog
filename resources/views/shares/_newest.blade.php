<div class="list-group" style="margin-top: 10px;">
    <a href="#" class="list-group-item active">
        <i class="fa fa-book" aria-hidden="true"></i> &nbsp;最新文章
    </a>
    @foreach($user->articles()->orderBy('created_at','desc')->take(5)->get() as $newArticle)
    <a href="{{ url()->route('users.articles.show',['user_id'=>$newArticle->user_id,'id'=>$newArticle->id]) }}" class="list-group-item">{{ $newArticle->title }}</a>
    @endforeach

</div>