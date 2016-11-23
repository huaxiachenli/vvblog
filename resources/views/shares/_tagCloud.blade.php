<div class="card">
    <h6 class="card-header">
        <i class="fa fa-cloud" aria-hidden="true"></i> 标签云
    </h6>
    <div class="card-block">
        @foreach($user->tags as $tag)
            <label for="label" class="tag {{ array_rand(['tag-default'=>0,'tag-primary'=>1,'tag-danger'=>2,'tag-success'=>3,'tag-info'=>4]) }}">{{ $tag->name }}</label>
        @endforeach

    </div>
</div>