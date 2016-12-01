<div class="meida" >
    <a href="" class="media-left">
        <img src="{{ url($comment->user->logo) }}" alt="" width="80" height="80">
    </a>
    <div class="media-body" data-comment-id="{{ $comment->id }}">
        <h6 class="media-heading">{{ $comment->user->name }} <small>{{ $comment->created_at }} #{{ $comment->floor}}</small></h6>
        {!! $comment->content !!}
        <div class="text-xs-right"><button class="btn btn-outline-info reply">回复</button></div>
    </div>
</div>
<hr>