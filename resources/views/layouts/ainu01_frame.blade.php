<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>アイヌ語講座</title>
    @vite(['resources/css/main.css'])

    <link href="../npm/bootstrap%405.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="../bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="../ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        h1{
            color: black;
            vertical-align: middle;
            padding: 60px 0;
            text-shadow:1px 1px 0 #808080, -1px -1px 0 #808080, -1px 1px 0 #808080, 1px -1px 0 #808080, 0px 1px 0 #808080, 0 -1px 0 #808080, -1px 0 0 #808080, 1px 0 0 #808080;
        }

        h5{
            text-align: center;
        }

        th,td,p,a{
            text-align: center;
        }

        .top-head{
            height: 200px;
            width: 100%;
            background-image: url(image/11-b-250.png);
            text-align: center;
            font: bolder;
        }

        .sidebar-content{
            padding: 0.5em 1em;
            margin: 2em 0;
            color: #FFF;
            background: #6eb7ff;
            border-bottom: solid 6px #3f87ce;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.25);
            border-radius: 9px;
        }

        .card-img-top{
            width: 50%;
            height: 50%;
            margin: 0 auto;
        }

        body{
            background-image: url(image/01-grey-65.png);
        }

        footer{
            width: 100%;
            height: 50px;
            font: sans-serif;
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 30px 0;
        }

        <!-- ここからクイズ用に追加 -->
        /* クイズのすべてを管理する親要素 */
        .quiz_area{
            position: relative;
            text-align: center;
        }

        .quiz_no{
            text-align: center;
        }

        /* 回答後に上に被せてタップできなくするための要素（デフォルト非表示、回答後に一時的に表示） */
        .quiz_area .quiz_area_bg{
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            left: 0;
            z-index: 999;
            background: rgba(0, 0, 0, 0.3);
            display: none;
            color: #FFF;
            text-align: center;
        }

        /* 画面に〇、×を表示するための要素（デフォルト非表示、回答後に一時的に表示） */
        .quiz_area .quiz_area_icon{
            position: absolute;
            box-sizing: border-box;
            top: 50%;
            left: 50%;
            z-index: 9999;
            transform: translate(-50%, -50%);
            color: red;
            display: none;
            font-size: 10em;
            font-weight: bold;
            -webkit-text-stroke: 4px #FFF;
            text-stroke: 4px #FFF;
        }

        /* .trueまたは.falseのクラスが付与されたら表示するものとみなす */
        .quiz_area .quiz_area_icon.true, .quiz_area .quiz_area_icon.false{
            display: block;
        }

        /* .trueは正解（〇を表示） */
        .quiz_area .quiz_area_icon.true:before{
            content: '〇';
            color: red;
        }
        /* .falseは不正解（×を表示） */
        .quiz_area .quiz_area_icon.false:before{
            content: '×';
            color: blue;
        }

        /* 現在の問題数を表示 */
        .quiz_area .quiz_no{
            font-weight: bold;
        }

        /* 問題文と回答後の結果（デザインは使いまわし） */
        .quiz_area .quiz_question, .quiz_result{
            box-sizing: border-box;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            padding: 15px;
            border: 4px solid #CCC;
            font-weight: bold;
        }

        /* 回答後の結果は初期非表示 */
        .quiz_area .quiz_result{
            display: none;
            text-align: center;
        }

        /* 以下クイズの選択肢のデザイン */
        .quiz_area .quiz_ans_area ul{
            margin: 10px 10px 10px 10px;
            padding: 20px;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .quiz_area .quiz_ans_area ul::after{
            content: "";
            display: block;
            clear: both;
        }

        .quiz_area .quiz_ans_area ul li{
            box-sizing: border-box;
            list-style: none;
            float: none;
            width: 100%;
            padding: 10px 15px;
            border: 2px solid #CCC;
            margin: 0 0 -2px 0;
            cursor: pointer;
            background-color: #FFFFFF;
        }

        .quiz_area .quiz_ans_area ul li.selected{
            background-color: #bcbcbc;
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
<!--<main class="container">-->
    @yield('content')
<!--</main>-->
<footer>
    &copy; 北海道大学 学習神経心理学ゼミ　錦川
</footer>
</body>
</html>
