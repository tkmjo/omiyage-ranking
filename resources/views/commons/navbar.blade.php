<header>
    <nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" area-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-left" href="/"><img src="{{ secure_asset("images/uQvn2EGS.png") }}" alt="おみやげランキング.com"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                     @if (Auth::check())
                        <li>
                                <select onchange="top.location.href=value">
                                    <option value=""><!-- <i class="fas fa-chart-bar"></i> -->ランキング</option>
                                    
                                    @foreach(config('pref') as $index => $name)
                                        <option value="{{ route('ranking.rank', $name) }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                        </li>
                        <li>
                            <a href="{{ route('omiyages.create') }}"><!-- <i class="fas fa-plus"></i> -->おみやげの追加</a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('users.favoriting', Auth::user()->id) }}"><!-- <i class="far fa-star"></i> -->お気に入り</a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('logout.get') }}"><!-- <i class="fas fa-user"></i> -->&nbsp;ログアウト</a>
                        </li>
                    @else
                        <li>
                                <select onchange="top.location.href=value">
                                    <option value=""><!-- <i class="fas fa-chart-bar"></i> -->ランキング</option>
                                    @foreach(config('pref') as $index => $name)
                                        <option value="{{ route('ranking.rank', $name) }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                        </li>
                        <li><a href="{{ route('signup.get') }}">会員登録</a></li>
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                    @endif 
                </ul>
            </div>
        </div>
    </nav>
</header>