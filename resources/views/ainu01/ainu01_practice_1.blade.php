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
            { question : 'アク(ak)', answer : ['弟', 'うらやましい', '～(複数形)が分かる']},
            { question : 'アプト(apto)', answer : ['雨', '木', '夫婦']},
            { question : 'アペ(ape)', answer : ['火', '～を知らない', '米']},
            { question : 'アムニン(amunin)', answer : ['腕', '～を背負う', '遊ぶ']},
            { question : 'イワン(iwan)', answer : ['6', '～を盗む', '苫小牧']},
            { question : 'ウニ(uni)', answer : ['家', '干し魚', '～に…を教える']},
            { question : 'エアニ(eani)', answer : ['あなた', '戻る', 'ネズミ']},
            { question : 'エトゥ(etu)', answer : ['鼻', 'うらやましい', '意味']},
            { question : 'オソロ(osor)', answer : ['尻', '冬', '～を盗む']},
            { question : 'オヌマン(onuman)', answer : ['夕方', 'ギョウジャニンニク', 'はずかしい']},
            { question : 'サパ(sapa)', answer : ['頭', '胸', 'はずかしい']},
            { question : 'シネ(sine)', answer : ['1', 'お菓子', '見る']},
            { question : 'チェプ(cep)', answer : ['魚', '米', '腹']},
            { question : 'チカッポ(cikappo)', answer : ['小鳥', '尻', '嘘をつく']},
            { question : 'チプ(cip)', answer : ['舟', '鞘', '胸']},
            { question : 'ト(to)', answer : ['日', 'ウサギ', '嘘をつく']},
            { question : 'トゥ(to)', answer : ['2', '風', '～をいじめる']},
            { question : 'トゥペサン(tupesan)', answer : ['8', '木', '胸']},
            { question : 'ナン(nan)', answer : ['顔', '～を作る', 'よい']},
            { question : 'ヌプリ(nupuri)', answer : ['山', '～を叩く', '冬']},
            { question : 'ハポ(hapo)', answer : ['お母さん(呼ぶとき)', '～(複数形)を開ける', '木']},
            { question : 'ピリカ(pirka)', answer : ['よい', 'うらやましい', '魚']},
            { question : 'ペンラム(penmam)', answer : ['胸', 'カレイ', 'トリカブト']},
            { question : 'ホ(ho)', answer : ['はい(返事)', 'イモ', '立つ']},
            { question : 'ポロ(poro)', answer : ['大きい', '太陽', '立つ']},
            { question : 'ポン(pon)', answer : ['小さい', '毎年', '難しい']},
            { question : 'マタ(mata)', answer : ['冬', '難しい', '～を背負う']},
            { question : 'ル(ru)', answer : ['道', '鼻', '～を聞く']},
            { question : 'ワッカ(wakka)', answer : ['水', 'はずかしい', '地面']},
            { question : 'ワン(wan)', answer : ['10', '～を叩いて刻む', '家']}
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
            window.location.href = '/ainu01/ainu01_practice_1';
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
            var quiz_pt = quiz_success_cnt;
            var text = quiz_fin_cnt + '問中' + quiz_success_cnt + '問正解！' + quiz_pt + 'pt 獲得！';

            results["quiz_point"] = quiz_pt;
            update(results);

            if(quiz_fin_cnt === quiz_success_cnt){
                text += '<br>全問正解おめでとう！';
                quiz_pt + 'pt 獲得！';
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
        fetch("/ainu01/ainu01_practice_1/create", {
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
        fetch("/ainu01/ainu01_practice_1/update", {
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
