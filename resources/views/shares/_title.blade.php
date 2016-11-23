
<div class="card">
    @if($user->profile)
    <div class="card-block">
        <h4 class="card-title">{{ $user->profile->title }}</h4>
        <h6 class="card-subtitle text-muted">{{ $user->profile->child_title  }}</h6>
    </div>
    <div class="card-block">
        <p class="card-text">{{ $user->profile->introduce }}</p>
    </div>
        @else
            <div class="card-block">
                欢迎来到{{ $user->name }}的博客
            </div>
        @endif
</div>
