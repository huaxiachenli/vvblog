<nav class="navbar navbar-light bg-faded">
    <div class="container">
        <a class="navbar-brand" href="{{ url()->route('users.index') }}">微播客</a>
        <button class="navbar-toggler hidden-lg-up pull-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-toggleable-md" id="navbarResponsive">

            <ul class="nav navbar-nav " id="authorNav">
                @if($user)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url()->route('articles.index',$user->id) }}">作者首页</a>
                </li>
                @endif
                @foreach($user->categories as $category)
                    <li class="nav-item dropdown" data-category-id="{{ $category->id }}">
                        <a href="#" class="nav-link dropdown-toggle" id="{{ $category->name }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="{{ $category->name }}">
                            @foreach($category->childCategories as $childCategory)
                                <a href="{{ url()->route('child_categories.show',[$user->id,$childCategory->id]) }}" class="dropdown-item">{{ $childCategory->name }}</a>
                            @endforeach

                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav float-lg-right">
                @if(Auth::guest())
                    <li class="nav-item">
                        <a href="{{ url('/login') }}" class="nav-link">登录</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/register') }}" class="nav-link">注册</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="responsiveNavbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="responsiveNavbarDropdown">
                            <a href="{{ url('/logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <a href="{{ url()->route('dashboard',$user->id) }}" class="dropdown-item">
                                dashboard
                            </a>
                            <a href="{{ url()->route('articles.index',Auth::user()->id) }}" class="dropdown-item">
                                我的主页
                            </a>

                        </div>
                    </li>

                @endif

            </ul>
            <form class="form-inline float-lg-right" action="/users/{{ $user->id }}/search" method="get">
                <input class="form-control" type="text" placeholder="标签&标题" name="search">
                <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>

        </div>
    </div>
</nav>