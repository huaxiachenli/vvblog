<div class="panel panel-primary">
    <div class="panel-heading"><i class="fa fa-cloud" aria-hidden="true"></i> 标签云</div>
    <div class="panel-body">
        @foreach($user->tags()->pluck('name') as $tag)
            <a href="{{ url()->route('tag',[$user->id,$tag]) }}">
                <span for="label"  style="margin-bottom: 20px;" class="label {{ array_rand(['label-default'=>0,'label-primary'=>1,'label-danger'=>2,'label-success'=>3,'label-info'=>4]) }}">{{ $tag }}</span>
            </a>
        @endforeach
    </div>
</div>