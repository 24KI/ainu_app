@extends('layouts.ainu01_frame')
@section('content')

<style type="text/css">
    .sidebar-content {
        margin: 0 auto;
    }
    .quiz_area{
        text-align: center;
    }
</style>

<div class="top-head">
    <h1>アイヌ語講座</h1>
</div>
<div class="col" style="background-color: #FFFFFF;">
    <div class="quiz_area">
        <div class="quiz_set">
            第<span class="quiz_no">0</span>問
            <div class="quiz_question"></div>
            <div class="quiz_ans_area">
                <ul></ul>
            </div>
            <div class="quiz_area_bg"></div>
            <div class="quiz_area_icon"></div>
        </div>
        <div class="quiz_result"></div>
    </div>
</div>

<script type="text/javascript">

    $(function(){

        create();

        var quizArea = $('.quiz_area'); //クイズを管理するDOMを指定
        var quiz_html = quizArea.html(); //もう一度　を押した時に元に戻すため初期HTMLを変数で保管
        var quiz_cnt = 0; //現在の問題数を管理
        var quiz_fin_cnt = 10; //何問で終了か設定（クイズ数以下であること）
        var quiz_success_cnt = 0; //問題の正解数

        var results = {};

        //クイズの配列を設定
        //answerの選択肢の数はいくつでもOK　ただし先頭を正解とすること(出題時に選択肢はシャッフルされる)
        var aryQuiz = [];
        aryQuiz.push(
            { question : 'イレンカ(irenka)', answer : ['法律・規則', '～(複数形)を開ける', '娘']},
            { question : 'ウレクレク(urekreku)', answer : ['なぞなぞする', '雪', '～を突く']},
            { question : 'エアイカプ(eaykap)', answer : ['～できない', '昔', '顔']},
            { question : 'エシクテ(esikte)', answer : ['～を…でいっぱいにする', 'そして', '法律・規則']},
            { question : 'エシケリムリム(eskerimrim)', answer : ['カタクリ', '紙', '～をする']},
            { question : 'エパカシヌ(epakasnu)', answer : ['～に…を教える', '～(複数形)が分かる', '美味しい']},
            { question : 'エヤム(eyam)', answer : ['～を大事にする', '鍋', '雪']},
            { question : 'オトゥタヌ(otutanu)', answer : ['次に', '本当に', '～を選ぶ']},
            { question : 'カムイチェプ(kamuycep)', answer : ['鮭(=神の食べ物)', '胸', 'お母さん(呼ぶとき)']},
            { question : 'キクレッポ(kikreppo)', answer : ['ヤマメ', '～を探す', 'おそろしい']},
            { question : 'キムンカムイ(kimunkamuy)', answer : ['熊(=山に住む神)', '～を取る', '8']},
            { question : 'ケシ　パ(kes pa)', answer : ['毎年', '道', '1']},
            { question : 'コイキ(koyki)', answer : ['～をいじめる', 'はずかしい', '～(複数形)を開ける']},
            { question : 'サッチェプ(satcep)', answer : ['干し魚', '宝物', '爪']},
            { question : 'スルク(surku)', answer : ['トリカブト', '～と一緒に', '～を盗む']},
            { question : 'タタタタ(tatatata)', answer : ['～を叩いて刻む', 'なぞなぞする', '利尻']},
            { question : 'タンタカ(tantaka)', answer : ['カレイ', 'エゾリス', '～を作る']},
            { question : 'トゥスニンケ(tusuninke)', answer : ['エゾリス', 'おばあさん', 'ヤチブキ']},
            { question : 'トゥマム(tumam)', answer : ['胴体', '罰が当たる', '次に']},
            { question : 'トゥラノ(turano)', answer : ['～と一緒に', 'うらやましい', '顔']},
            { question : 'ニンカリ(ninkari)', answer : ['イヤリング', '～を持つ', '臼']},
            { question : 'ヌイエ(nuye)', answer : ['～を彫る', '～を探す', '利尻']},
            { question : 'パラコアッ(parkoat)', answer : ['罰が当たる', 'よい', 'ありがとう']},
            { question : 'プイ(puy)', answer : ['ヤチブキ', '腕', '眠る']},
            { question : 'プクサ(pukusa)', answer : ['ギョウジャニンニク', '～(複数形)が分かる', '(単数形が)走る']},
            { question : 'フチ(huci)', answer : ['おばあさん', 'あなた', '～のそば']},
            { question : 'マレク(marek)', answer : ['銛鉤(釣り道具)', 'おばあさん', '～(複数形)を開ける']},
            { question : 'ミナ(mina)', answer : ['～が笑う', '～を使う', '利尻']},
            { question : 'ヤイシトマ(yaysitoma)', answer : ['はずかしい', '風', '魚']},
            { question : 'ライケ(rayke)', answer : ['～(単数形)を殺す', '姉', 'エゾリス']}
           );

        quizReset();

        //回答を選択した後の処理
        quizArea.on('click', '.quiz_ans_area ul li', function(){
            //画面を暗くするボックスを表示（上から重ねて、結果表示中は選択肢のクリックやタップを封じる
            quizArea.find('.quiz_area_bg').show();
            //選択した回答に色を付ける
            $(this).addClass('selected');

            var correctness;

            if($(this).data('true')){
                //正解の処理 〇を表示
                quizArea.find('.quiz_area_icon').addClass('true');
                //正解数をカウント
                quiz_success_cnt++;

                correctness = 1;

            }else{
                //不正解の処理
                quizArea.find('.quiz_area_icon').addClass('false');

                correctness = 0;
            }

            results[`question${quiz_cnt + 1}`] = correctness;
            results["quiz_success_count"] = quiz_success_cnt;

            update(results)

            setTimeout(function(){
                //表示を元に戻す
                quizArea.find('.quiz_ans_area ul li').removeClass('selected');
                quizArea.find('.quiz_area_icon').removeClass('true false');
                quizArea.find('.quiz_area_bg').hide();
                //問題のカウントを進める
                quiz_cnt++;
                if(quiz_fin_cnt > quiz_cnt){
                    //次の問題を設定する
                    quizShow();
                }else{
                    //結果表示画面を表示
                    quizResult();
                }
            }, 1000);
        });

        //もう一度挑戦するを押した時の処理
        quizArea.on('click', '.quiz_restart', function(){
            quizReset();
        });

        //追加した
        quizArea.on('click', '.agaain', function(){
            quizOnemore();
        });

        quizArea.on('click','.page_back', function(){
            pageback();
        });
        quizArea.on('click','.go_home', function(){
            gohome();
        });

        //リセットを行う関数
        function quizReset(){
            quizArea.html(quiz_html); //表示を元に戻す
            quiz_cnt = 0;
            quiz_success_cnt = 0;
            aryQuiz = arrShuffle(aryQuiz);
            quizShow();
        }

        function quizOnemore(){
            window.location.href = '/ainu01/ainu01_practice_5';
        }

        //問題を表示する関数
        function quizShow(){
            //何問目かを表示
            quizArea.find('.quiz_no').text((quiz_cnt + 1));
            //問題文を表示
            quizArea.find('.quiz_question').text(aryQuiz[quiz_cnt]['question']);
            //正解の回答を取得する
            var success = aryQuiz[quiz_cnt]['answer'][0];
            //現在の選択肢表示を削除する
            quizArea.find('.quiz_ans_area ul').empty();
            //問題文の選択肢をシャッフルさせる(自作関数) .concat()は参照渡し対策
            var aryHoge = arrShuffle(aryQuiz[quiz_cnt]['answer'].concat());
            //問題文の配列を繰り返し表示する
            $.each(aryHoge, function(key, value){
                var fuga = '<li>' + value + '</li>';
                //正解の場合はdata属性を付与する
                if(success === value){
                    fuga = '<li data-true="1">' + value + '</li>';
                }
                quizArea.find('.quiz_ans_area ul').append(fuga);
            });
        }

        function gohome(){
            window.location.href = '/ainu01/ainu01';
        }
        function pageback(){
            window.location.href = '/ainu01/ainu01_practice_menu';
        }

        //結果を表示する関数
        function quizResult(){
            quizArea.find('.quiz_set').hide();
            var quiz_pt = quiz_success_cnt*5;
            var text = quiz_fin_cnt + '問中' + quiz_success_cnt + '問正解！' + quiz_pt + 'pt 獲得！';

            results["quiz_point"] = quiz_pt;
            update(results);

            if(quiz_fin_cnt === quiz_success_cnt){
                text += '<br>全問正解おめでとう！';
                quiz_fin_cnt + 'pt 獲得！';
            }
            text += '<br><input type="button" value="もう一度やる" class="agaain">';
            text += '<br><input type="button" value="レベル選択に戻る" class="page_back">';
            text += '<br><input type="button" value="トップページに戻る" class="go_home">';
            quizArea.find('.quiz_result').html(text);
            quizArea.find('.quiz_result').show();
        }

        //配列をシャッフルする関数
        function arrShuffle(arr){
            for(i = arr.length - 1; i > 0; i--){
                var j = Math.floor(Math.random() * (i + 1));
                var tmp = arr[i];
                arr[i] = arr[j];
                arr[j] = tmp;
            }
            return arr;
        }
    });

    async function create() {

        // 本番環境では先頭に..をつける。
        fetch("/ainu01/ainu01_practice_5/create", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: {}
        })
            .then(res => { console.log(res); })
            .catch(err => console.log(err));
    }

    async function update(results) {

        // 本番環境では先頭に..をつける。
        fetch("/ainu01/ainu01_practice_5/update", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(results)
        })
            .then(res => { console.log(res); })
            .catch(err => console.log(err));
    }
</script>

@endsection()
