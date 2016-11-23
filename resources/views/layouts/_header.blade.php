<header class="container-fluid bg-info" id="logo">
        <img src="{{ url('/avatar/'.$user->logo) }}" alt="" width="120px" height="120px" class="rounded-circle">
    {{--<img src="https://avatars2.githubusercontent.com/u/13694887?v=3&s=466" alt="" width="120px" height="120px">--}}
    <p>
        @if($professions = $user->professions)
            @foreach($professions as $profession)
              <span class="tag tag-default" id="label-left">{{ $profession->name }}</span>&nbsp;
            @endforeach
        @else
              <span class="tag tag-default" id="label-left">文字爱好者</span>
        @endif
    </p>
    <h3>{{ $user->name }}</h3>
</header>