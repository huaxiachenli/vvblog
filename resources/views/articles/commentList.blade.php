<div class="meida" >
    <a href="" class="media-left">
        <img src="{{ url($comment->user->logo) }}" alt="" width="80" height="80">
    </a>
    <div class="media-body" data-comment-id="{{ $comment->id }}">
        <h6 class="media-heading"><span class="user-name">{{ $comment->user->name }}</span> <small>{{ $comment->created_at }} #{{ $comment->floor}}</small></h6>
        {!! $comment->content !!}
        <div class="text-right"><button class="btn btn-info reply">回复</button></div>
    </div>
</div>
<hr>