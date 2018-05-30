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
                            <a href="#">
                                <select>
                                    @foreach(config('pref') as $index => $name)
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('omiyages.create') }}">おみやげの追加</a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('users.favoriting', Auth::user()->id) }}">お気に入り</a>
                        </li>
                        
                        
                        <li>
                            <a href="{{ route('logout.get') }}">ログアウト</a>
                        </li>
                    @else
                        <li>
                            <a href="#">
                                <select>
                                    @foreach(config('pref') as $index => $name)
                                        <option value="{{ $index }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </a>
                        </li>
                        <li><a href="{{ route('signup.get') }}">会員登録</a></li>
                        <li><a href="{{ route('login') }}">ログイン</a></li>
                    @endif 
                </ul>
            </div>
        </div>
    </nav>
</header>