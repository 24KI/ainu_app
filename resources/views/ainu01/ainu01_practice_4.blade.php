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
            { question : 'アイヌパタ(aynupata)', answer : ['うらやましい', '～を…でいっぱいにする', '魚']},
            { question : 'アシトマ(asitoma)', answer : ['おそろしい', '～を彫る', '尻']},
            { question : 'アチャポ(acapo)', answer : ['おじさん', '薪', 'あなた']},
            { question : 'アマメチカッポ(amamecikappo)', answer : ['スズメ', '～の味がする', '冬']},
            { question : 'イコロ(ikor)', answer : ['宝物', '～を見る', '～を待つ']},
            { question : 'イチャヌイ(icanuy)', answer : ['マス(鱒)', 'ヤチブキ', '(単数形が)上がる']},
            { question : 'エイッカ(eikka)', answer : ['～を盗む', '～に怒る', '木']},
            { question : 'エラミシカリ(eramiskari)', answer : ['～を知らない', '8', '～(単数形)を開ける']},
            { question : 'オツケ(otke)', answer : ['～を突く', '弟', '臼']},
            { question : 'カルシ(karus)', answer : ['キノコ', 'ギョウジャニンニク', '夫婦']},
            { question : 'カンピ(kampi)', answer : ['紙', 'カレイ', '(単数形が)上がる']},
            { question : 'キク(kik)', answer : ['～を叩く', 'キツネ', '～を取る']},
            { question : 'ケプシペ(kepuspe)', answer : ['鞘', '日', '舟']},
            { question : 'ケラアン(keraan)', answer : ['美味しい', '～を聞く', '～を取る']},
            { question : 'サム(sam)', answer : ['～のそば', '～を待つ', '臼']},
            { question : 'スンケ(sunke)', answer : ['嘘をつく', '戻る', '村']},
            { question : 'セ(se)', answer : ['～を背負う', '～を持つ', '～を知っている']},
            { question : 'ソンノ(sonno)', answer : ['本当に', 'ウサギ', 'おばあさん']},
            { question : 'タン(tan)', answer : ['この', '銛鉤(釣り道具)', '～を持つ']},
            { question : 'トアン(toan)', answer : ['あの', '～を作る', '～を彫る']},
            { question : 'トマコマイ(tomakomay)', answer : ['苫小牧', '～できない', '休む']},
            { question : 'ニ(ni)', answer : ['薪', 'カタクリ', '泳ぐ']},
            { question : 'ニス(nisu)', answer : ['臼', '6', '1']},
            { question : 'ヒナク(hinak)', answer : ['どこ', '尻', 'エゾリス']},
            { question : 'フナラ(hunara)', answer : ['～を探す', '村', '～が笑う']},
            { question : 'ホカンパ(hokampa)', answer : ['難しい', '～(単数形)を開ける', '戻る']},
            { question : 'マキリ(makiri)', answer : ['小刀', '～を着る', '法律・規則']},
            { question : 'ムカラ(mukar)', answer : ['斧', 'おそろしい', 'どこ']},
            { question : 'ラク(rak)', answer : ['～の味がする', '胴体', 'この']},
            { question : 'リシリ(risir)', answer : ['利尻', '～に怒る', '年']}
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
            window.location.href = '/ainu01/ainu01_practice_4';
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
            var quiz_pt = quiz_success_cnt*3;
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
        fetch("/ainu01/ainu01_practice_4/create", {
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
        fetch("/ainu01/ainu01_practice_4/update", {
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
