@extends('layouts.ainu02_frame')
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
            { question : 'アイヌ(aynu)', answer : [ '人', '何', '～で遊ぶ']},
            { question : 'アエプ(aep)', answer : [ '食べ物', '首', '～を言う']},
            { question : 'アシクネ(asikne)', answer : [ '5', '～を守る', '富良野']},
            { question : 'アトゥイ(atuy)', answer : [ '海', 'ところ', 'ニリンソウ']},
            { question : 'アニ(ani)', answer : [ '～を手に持つ', '少年', '蟹']},
            { question : 'アプカシ(apkas)', answer : [ '歩く', '～で遊ぶ', '～ができる']},
            { question : 'アミプ(amip)', answer : [ '着物', '木の葉', '～を助ける']},
            { question : 'アム(am)', answer : [ '爪', '蟹', 'お父さん(呼ぶとき)']},
            { question : 'アラキ(arki)', answer : [ '(複数人が)来る', '今日', '太刀']},
            { question : 'アラワン(arwan)', answer : [ '7', '食べ物', 'カツラ(樹木)']},
            { question : 'アンパヤヤ(ampayaya)', answer : [ '蟹', '息子', '～ができる']},
            { question : 'イエ(ye)', answer : [ '～を言う', '～(単数形)を切る', '稚内']},
            { question : 'イケウ(ikkew)', answer : [ '腰', '～(複数形)を切る', '(複数形が)上がる']},
            { question : 'イタク(itak)', answer : [ '話す', 'カラス', '逃げる']},
            { question : 'イチェン(icen)', answer : [ 'お金', '髪', '何']},
            { question : 'イネ(ine)', answer : [ '4', 'カツラ(樹木)', '食べ物']},
            { question : 'イペ(ipe)', answer : [ '食事する', '外', '～を言う']},
            { question : 'イヨハイシトマレ(iyahaysitomare)', answer : [ 'おどろいた', '太刀', '料理する']},
            { question : 'イリワク(irwak)', answer : [ '兄弟', '母親', 'おじいさん']},
            { question : 'ウシケ(uske)', answer : [ 'ところ', '山を下りる', 'タヌキ']},
            { question : 'ウナルペ(unarpe)', answer : [ 'おばさん', '虫', '意味']},
            { question : 'ウヌ(unu)', answer : [ '母親', 'ありがとう', '妻']},
            { question : 'ウレ(ure)', answer : [ '足', '(複数人が)来る', '～を言う']},
            { question : 'ウンマ(umma)', answer : [ '馬', '～ができる', 'オオウバユリ']},
            { question : 'エ(e)', answer : [ '～を食べる', '稚内', '夏']},
            { question : 'エアシカイ(easkay)', answer : [ '～ができる', '父親', '食事する']},
            { question : 'エイヨク(eyyok)', answer : [ '～を売る', 'ニリンソウ', 'ネコ']},
            { question : 'エカシ(ekasi)', answer : [ 'おじいさん', '9', '(消費物)を借りる']},
            { question : 'エク(ek)', answer : [ '(一人が)来る', '富良野', '舟を漕ぐ']},
            { question : 'エシノツ(esinot)', answer : [ '～で遊ぶ', '～(単数形)が分かる', '全体']},
            { question : 'エソウク(esouk)', answer : [ '(消費物)を借りる', '本', '～で遊ぶ']},
            { question : 'エチオカ(ecioka)', answer : [ 'あなたたち', '～を忘れる', 'ありがとう']},
            { question : 'エトゥン(etun)', answer : [ '(消費しないもの)を借りる', '～を助ける', '～で遊ぶ']},
            { question : 'エプンキネ(epunkine)', answer : [ '～を守る', '兄', '～を隠す']},
            { question : 'エムシ(emus)', answer : [ '太刀', 'トウモロコシ', '窓']},
            { question : 'エヤプキリ(eyapkir)', answer : [ '～を投げる', '口', '～を終える']},
            { question : 'エラムアン(eramuan)', answer : [ '～(単数形)が分かる', '肉', '今日']},
            { question : 'オイカ(oika)', answer : [ '～を越えて', '爪', '秋']},
            { question : 'オイラ(oyra)', answer : [ '～を忘れる', '秋', '耳']},
            { question : 'オケレ(okere)', answer : [ '～を終える', '和人', '～(複数形)を切る']},
            { question : 'オタ(ota)', answer : [ '砂', '死んだふりをする', '兄弟']},
            { question : 'オッカヨ(okkayo)', answer : [ '男', 'オオウバユリ', '～に触る']},
            { question : 'オトプ(otop)', answer : [ '髪', 'カツラ(樹木)', '5']},
            { question : 'オナ(ona)', answer : [ '父親', '～を隠す', 'クジラ']},
            { question : 'オハウキナ(ohawkina)', answer : [ 'ニリンソウ', '少年', '死んだふりをする']},
            { question : 'オピッタ(opitta)', answer : [ '全体', '5', '歩く']},
            { question : 'オマプ(omap)', answer : [ '～をかわいがる', '死んだふりをする', '乾く']},
            { question : 'オルシペ(oruspe)', answer : [ '話', '～を助ける', '～(複数形)を折る']},
            { question : 'カイパ(kaypa)', answer : [ '～(複数形)を折る', '料理する', '春']},
            { question : 'カスイ(kasuy)', answer : [ '～を助ける', '死んだふりをする', '父親']},
            { question : 'カニ(kani)', answer : [ '私', '～を終える', '兄']},
            { question : 'カム(kam)', answer : [ '肉', 'アメマス', '白い']},
            { question : 'カラク(karku)', answer : [ '甥', '父親', '和人']},
            { question : 'カンピソシ(kampisos)', answer : [ '本', '～(複数形)を切る', '(単数形が)起き上がる']},
            { question : 'キキリ(kikir)', answer : [ '虫', '～(複数形)を折る', '(複数人が)来る']},
            { question : 'キサラ(kisar)', answer : [ '耳', '北海道', '～をかわいがる']},
            { question : 'キナカラ(kinakar)', answer : [ '山菜を取る', '父親', '木の葉']},
            { question : 'キミ(kimi)', answer : [ 'トウモロコシ', '遠い', '富良野']},
            { question : 'キラ(kira)', answer : [ '逃げる', '乾く', '甥']},
            { question : 'クッ(kut)', answer : [ '帯', '死んだふりをする', '兄弟']},
            { question : 'ケシトアンコロ(kestoankor)', answer : [ '毎月', 'フキ', '林']},
            { question : 'ケレ(ker)', answer : [ '靴', '骨', '冷たい']},
            { question : 'ケレ(kere)', answer : [ '～に触る', '～ができる', '着物']},
            { question : 'コタンコロカムイ(kotankorkamy)', answer : [ 'シマフクロウ', '～ができる', 'ありがとう']},
            { question : 'コニム(konimu)', answer : [ '～をのぼる', '～を叩き切る', 'ところ']},
            { question : 'コロコニ(korkoni)', answer : [ 'フキ', '春', '～を言う']},
            { question : 'コンル(konru)', answer : [ '氷', '疲れる', '手']},
            { question : 'サク(sak)', answer : [ '夏', '(複数形が)走る', '～を投げる']},
            { question : 'サッ(sat)', answer : [ '乾く', '長い', '馬']},
            { question : 'サッケ(satke)', answer : [ '～を干す', '(一人が)来る', '首']},
            { question : 'サン(san)', answer : [ '山を下りる', '首', '氷']},
            { question : 'シク(sik)', answer : [ '目', '本', '妻']},
            { question : 'シサム(sisam)', answer : [ '和人', '～(複数形)を殺す', '肉']},
            { question : 'シネぺサン(sinepesan)', answer : [ '9', '山菜を取る', '肉']},
            { question : 'シライレ(sirayre)', answer : [ '死んだふりをする', '7', '白い']},
            { question : 'シリセセク(sirsesek)', answer : [ '暑い', 'タヌキ', 'ウグイ']},
            { question : 'シンキ(sinki)', answer : [ '疲れる', '昨日', '靴']},
            { question : 'スケ(suke)', answer : [ '料理する', '～(単数形)を切る', 'カエル']},
            { question : 'スッ(sut)', answer : [ '祖母', '寝る', '食べ物']},
            { question : 'スプン(supun)', answer : [ 'ウグイ', '食べ物', 'カツラ(樹木)']},
            { question : 'スマ(suma)', answer : [ '石', '4', '全体']},
            { question : 'セトゥル(setur)', answer : [ '背中', 'あなたたち', '稚内']},
            { question : 'ソイ(soy)', answer : [ '外', '柄', '腰']},
            { question : 'タウキ(tauki)', answer : [ '～を叩き切る', '首', '夏']},
            { question : 'タント(tanto)', answer : [ '今日', 'カラス', '川']},
            { question : 'タンネ(tanne)', answer : [ '長い', '冷たい', '妻']},
            { question : 'チカプ(cikap)', answer : [ '鳥', '夫', '女']},
            { question : 'チポ(cipo)', answer : [ '舟を漕ぐ', '～を忘れる', '～を研ぐ']},
            { question : 'チャペ(cape)', answer : [ 'ネコ', '夏', '男']},
            { question : 'チュク(cuk)', answer : [ '秋', '夫', '歩く']},
            { question : 'テク(tek)', answer : [ '手', '酒', '死んだふりをする']},
            { question : 'テレケイペ(terkeype)', answer : [ 'カエル', '4', '～を忘れる']},
            { question : 'トゥイエ(tuye)', answer : [ '～(単数形)を切る', '～を研ぐ', '(複数形が)上がる']},
            { question : 'トゥイパ(tuypa)', answer : [ '～(複数形)を切る', '～をのぼる', '(複数形が)上がる']},
            { question : 'トゥイマ(tuyma)', answer : [ '遠い', '料理する', '本']},
            { question : 'トゥクシシ(tukusis)', answer : [ 'アメマス', '暑い', '酒']},
            { question : 'トゥレプ(turep)', answer : [ 'オオウバユリ', '(消費しないもの)を借りる', '少年']},
            { question : 'トカプ モコロ(tokap mokor)', answer : [ '昼寝', '～を運ぶ', '～を終える']},
            { question : 'トノト(tonoto)', answer : [ '酒', 'ネコ', '7']},
            { question : 'トランネ(toranne)', answer : [ '怠ける', '～を守る', '腰']},
            { question : 'ナム(nam)', answer : [ '冷たい', 'アメマス', '太刀']},
            { question : 'ニセウ(nisew)', answer : [ 'ドングリ', '石', '妻']},
            { question : 'ニタイ(nitay)', answer : [ '林', '骨', '～(単数形)が分かる']},
            { question : 'ニハム(niham)', answer : [ '木の葉', '首', 'あなたたち']},
            { question : 'ニプ(nip)', answer : [ '柄', 'お金', '～を隠す']},
            { question : 'ヌイナ(nuyna)', answer : [ '～を隠す', '～を言う', '～を守る']},
            { question : 'ヌプリコロカムイ(nupurikorkamuy)', answer : [ '熊(=山を守る神)', '(消費物)を借りる', '富良野']},
            { question : 'ヌペ(nupe)', answer : [ '涙', 'ニリンソウ', '～を手に持つ']},
            { question : 'ヌマン(numan)', answer : [ '昨日', '父親', '母親']},
            { question : 'ネプキ(nepki)', answer : [ '働く', '砂', 'シマフクロウ']},
            { question : 'ノンノ(nonno)', answer : [ '花', '酒', 'アメマス']},
            { question : 'パイカラ(paykar )', answer : [ '春', '母親', '～をかわいがる']},
            { question : 'パシクル(paskur)', answer : [ 'カラス', '背中', '川']},
            { question : 'パスイ(pasuy)', answer : [ '箸', '暑い', '食べ物']},
            { question : 'パラ(par)', answer : [ '口', '孫', '外']},
            { question : 'ヒオーイオイ(hioy oy)', answer : [ 'ありがとう', '男', '腰']},
            { question : 'プクサキナ(pukusakina)', answer : [ 'ニリンソウ', '～を投げる', '名前']},
            { question : 'プクル(pukuru)', answer : [ '袋', '～を忘れる', '山菜を取る']},
            { question : 'プヤラ(puyar)', answer : [ '窓', '口', '食べ物']},
            { question : 'フラヌイ(huranuy)', answer : [ '富良野', '熊(=山を守る神)', '柄']},
            { question : 'フンぺ(humpe)', answer : [ 'クジラ', '氷', '全体']},
            { question : 'ヘカチ(hekaci)', answer : [ '少年', 'ネコ', '話']},
            { question : 'ペッ(pet)', answer : [ '川', '爪', 'おじいさん']},
            { question : 'ヘペレ(heper)', answer : [ '子熊', '馬', '蟹']},
            { question : 'ヘマンタ(hemanta)', answer : [ '何', '～ができる', '～を終える']},
            { question : 'ポ(po)', answer : [ '息子', '(複数人が)来る', '食事する']},
            { question : 'ホク(hok)', answer : [ '夫', '～をかわいがる', '女']},
            { question : 'ホッケ(hokke)', answer : [ '寝る', '(複数人が)来る', '息子']},
            { question : 'ポネ(pone)', answer : [ '骨', '(消費しないもの)を借りる', '林']},
            { question : 'ホプニ(hopuni)', answer : [ '(単数形が)起き上がる', '～(単数形)を切る', 'タヌキ']},
            { question : 'ホユプ(hoyupu)', answer : [ '(複数形が)走る', 'ニリンソウ', '耳']},
            { question : 'ポル(poru)', answer : [ '洞穴', '息子', '～を忘れる']},
            { question : 'マッ(mat)', answer : [ '妻', '(消費物)を借りる', '氷']},
            { question : 'マッカラク(matkarku)', answer : [ '姪', '人', '5']},
            { question : 'ミチ(mici)', answer : [ 'お父さん(呼ぶとき)', '髪', '骨']},
            { question : 'ミッポ(mippo)', answer : [ '孫', '花', 'シマフクロウ']},
            { question : 'メノコ(menoko)', answer : [ '女', 'アメマス', '洞穴']},
            { question : 'モユク(moyuk)', answer : [ 'タヌキ', '(複数形が)走る', '～を助ける']},
            { question : 'ヤウンモシリ(yaunmosir)', answer : [ '北海道', '～を忘れる', '昼寝']},
            { question : 'ヤムワッカナイ(yamwakkanay)', answer : [ '稚内', '柄', '髪']},
            { question : 'ユプ(yup)', answer : [ '兄', 'おじいさん', '外']},
            { question : 'ランコ(ranko)', answer : [ 'カツラ(樹木)', '虫', '～を終える']},
            { question : 'リキプ(rikip)', answer : [ '(複数形が)上がる', '林', '富良野']},
            { question : 'ルイケ(ruyke)', answer : [ '～を研ぐ', '働く', '虫']},
            { question : 'ルラ(rura)', answer : [ '～を運ぶ', '舟を漕ぐ', '秋']},
            { question : 'レ(re)', answer : [ '3', '酒', '～を投げる']},
            { question : 'レクッ(rekut)', answer : [ '首', '口', 'ありがとう']},
            { question : 'レタラ(retar)', answer : [ '白い', '～(複数形)を折る', '(複数人が)来る']},
            { question : 'レヘ(rehe)', answer : [ '名前', '歩く', '(消費物)を借りる']},
            { question : 'ロンヌ(ronnu)', answer : [ '～(複数形)を殺す', '川', '涙']},
            { question : 'ワッカタ(wakkata)', answer : [ '水を汲む', '髪', 'オオウバユリ']}
        );

        quizReset();

        //回答を選択した後の処理
        quizArea.on('click', '.quiz_ans_area ul li', function(){
            var correctness;

            if($(this).data('true')){
                //正解数をカウント
                quiz_success_cnt++;

                correctness = 1;

            }else{
                correctness = 0;
            }

            results[`question${quiz_cnt + 1}`] = correctness;
            results["quiz_success_count"] = quiz_success_cnt;

            update(results)

            setTimeout(function(){
                //問題のカウントを進める
                quiz_cnt++;
                if(quiz_fin_cnt > quiz_cnt){
                    //次の問題を設定する
                    quizShow();
                }else{
                    //結果表示画面を表示
                    quizResult();
                }
            }, 200);
        });

        quizArea.on('click','.page_back', function(){
            pageback();
        });

        //リセットを行う関数
        function quizReset(){
            quizArea.html(quiz_html); //表示を元に戻す
            quiz_cnt = 0;
            quiz_success_cnt = 0;
            aryQuiz = arrShuffle(aryQuiz);
            quizShow();
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

        function pageback(){
            window.location.href = '/ainu02/ainu02';
        }

        //結果を表示する関数
        function quizResult(){
            quizArea.find('.quiz_set').hide();
            var text = quiz_fin_cnt + '問中' + quiz_success_cnt + '問正解'

            text += '<br><input type="button" value="トップページに戻る" class="page_back">';
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
        fetch("/ainu02/ainu02_practice/create", {
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
        fetch("/ainu02/ainu02_practice/update", {
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
