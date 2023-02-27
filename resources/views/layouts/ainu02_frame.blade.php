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
            padding: 30px 0;
        }

        a{
            color: black;
        }

        .top-head{
            height: 100px;
            width: 100%;
            border-bottom: 3px solid #000000;
            text-align: center;
        }

        .question{
            text-align: center;
        }

        .sen_q{
            display: inline-block;
            padding: 10px ;
            border: 2px solid;
        }

        .sen_a{
            display: inline-block;
            padding: 10px;
            border: 2px solid;
        }



        img{
            display: block;
            margin: 0 auto;
            border: 2px solid;
        }

        table{
            table-layout: fixed;
            border: 2px solid;
            width: 635px;
        }

        table td{
            border: 1px solid;
            padding: 2px 2px;
            text-align: center;
        }

        footer{
            width: 100%;
            height: 50px;
            text-align: center;
            padding: 30px 0;
            border-top : 3px solid #000000;
            bottom: 0; /*下に固定*/
        }

        <!-- ここからクイズ用に追加 -->
        /* クイズのすべてを管理する親要素 */
        .quiz_area{
            position: relative;
            text-align: center;
        }

        /* .trueまたは.falseのクラスが付与されたら表示するものとみなす */
        .quiz_area .quiz_area_icon.true, .quiz_area .quiz_area_icon.false{
            display: block;
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
