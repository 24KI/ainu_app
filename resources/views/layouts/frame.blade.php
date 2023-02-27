<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アイヌ語講座</title>
    @vite(['resources/css/main.css'])

    <style>
        .wrapper{
            min-height: 100vh;
            position: relative;/*←相対位置*/
            padding-bottom: 120px;/*←footerの高さ*/
            box-sizing: border-box;/*←全て含めてmin-height:100vhに*/
        }

        footer{
            width: 100%;
            height: 50px;
            font: sans-serif;
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 30px 0;
            position: absolute;/*←絶対位置*/
            bottom: 0; /*下に固定*/
        }
    </style>
</head>
<body>
<header>
    <a href="/" class="site-title">アイヌ語講座</a>
    <nav class="tab">
        <ul>
            @if (Auth::check())
            @if (Auth::user()->type == 0)
            <li><a class="tab-item{{ Request::is('home') ? ' active' : ''}}" href="{{ route('home') }}">ホーム</a></li>
            @elseif (Auth::user()->type == 1)
            <li><a class="tab-item{{ Request::is('admin.home') ? ' active' : ''}}" href="{{ route('admin.home') }}">ホーム</a></li>
            @endif
            <li>
                <form on-submit="return confirm('ログアウトしますか？')" action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            </li>
            @else
            <li><a href="{{ route('login') }}">ログイン</a></li>
            <li><a href="{{ route('register') }}">登録</a></li>
            @endif
        </ul>
    </nav>
</header>
<div class="wrapper">
    <main class="container">
        @yield('content')
    </main>
    <footer>
        &copy; 北海道大学 関研究室　錦川
    </footer>
</div>
</body>
</html>
