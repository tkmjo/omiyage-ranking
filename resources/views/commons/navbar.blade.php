<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" area-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-left" href="/">おみやげランキング.com</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                     @if (Auth::check())
                        <li>
                            <a href="#">ランキング（後ほどセレクトボックス実装）</a>
                        </li>
                        <li>
                            <a href="#">おみやげの追加</a>
                        </li>
                        <li>
                            <a href="#">お気に入り</a>
                        </li>
                        <li>
                            <a href="{{ route('logout.get') }}">ログアウト</a>
                        </li>
                    @else
                        <li><a href="{{ route('signup.get') }}">会員登録</a></li>
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                        <li><a href="#">ランキング</a></li>
                    @endif 
                </ul>
            </div>
        </div>
    </nav>
</header>