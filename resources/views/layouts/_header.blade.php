<header class="container-fluid bg-green-active text-center " id="logo">
        <img src=" {{ asset($user->logo) }}" alt="" width="120px" height="120px" class="img-circle" style="margin-top: 10px">
    <p>
        @if($professions = $user->professions)
            @foreach($professions as $profession)
              <span class="label label-primary" id="label-left">{{ $profession->name }}</span>&nbsp;
            @endforeach
        @else
              <span class="tag tag-default">文字爱好者</span>
        @endif
    </p>
    <h3>{{ $user->name }}</h3>
</header>