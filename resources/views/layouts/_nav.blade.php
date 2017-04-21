<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><b>VVB</b>log</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url()->route('users.articles.index',['user_id'=>$user->id]) }}">首页 <span class="sr-only">(current)</span></a></li>
                    @foreach($user->categories as $category)
                        <li class="dropdown">
                            <a href="{{ url()->route('users.categories.show',['user_id'=>$user->id,'category'=>$category->id]) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($category->childCategories as $childCategory)
                                    <li><a href="{{ url()->route('users.child_categories.show',['user_id'=>$user->id,'$childCategory'=>$childCategory->id]) }}">{{ $childCategory->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                    @endforeach
                </ul>
                <form class="navbar-form navbar-left" role="search" action="/users/{{ $user->id }}/search" method="get">
                    <input class="form-control" type="text" placeholder="标签&标题" name="search" id="navbar-search-input">
                    <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li class="dropdown">
                            <a href="" data-toggle="dropdown" class="dropdown-toggle">{{ Auth::user()->name }}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href=""></a></li>
                                <li>
                                    <a href="{{ url('/logout') }}" class="dropdown-item"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        退出登录
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                                <li><a href="/home">进入控制台</a></li>
                                <li><a href="{{ url()->route('users.articles.index',Auth::user()->id) }}">个人主页</a></li>
                            </ul>
                        </li>
                        
                    @else
                    <li><a href="/login">登录</a></li>
                    <li><a href="/register">注册</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
