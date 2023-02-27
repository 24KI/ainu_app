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
        var quizArea = $('.quiz_area'); //クイズを管理するDOMを指定
        var quiz_html = quizArea.html(); //もう一度　を押した時に元に戻すため初期HTMLを変数で保管
        var quiz_cnt = 0; //現在の問題数を管理
        var quiz_fin_cnt = 10; //何問で終了か設定（クイズ数以下であること）
        var quiz_success_cnt = 0; //問題の正解数
        var results = {};
        // 本番環境では先頭に..をつける。
        post("/ainu01/ainu01_today_challenge/create", results);

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
            { question : 'サッチェプ(satcep)', answer : ['干し魚', '宝物', 'あの']},
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
            { question : 'ライケ(rayke)', answer : ['～(単数形)を殺す', '姉', 'エゾリス']},
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
            { question : 'リシリ(risir)', answer : ['利尻', '～に怒る', '年']},
            { question : 'アイ(ay)', answer : ['矢', '風', 'あなた']},
            { question : 'イキ(iki)', answer : ['～をする', '～(複数形)を開ける', '鼻']},
            { question : 'イセポ(isepo)', answer : ['ウサギ', '頭', 'なぞなぞする']},
            { question : 'イヤイライケレ(iyairaikere)', answer : ['ありがとう', '～(複数形)を開ける', '～を作る']},
            { question : 'ウク(uk)', answer : ['～を取る', '胴体', '言う']},
            { question : 'エモ(emo)', answer : ['イモ', 'お菓子', '利尻']},
            { question : 'エラムオカ(eramuoka)', answer : ['～(複数形)が分かる', '～に…を教える', 'はい(返事)']},
            { question : 'オ(o)', answer : ['～に乗る', 'ヤチブキ', '(複数形が)起き上がる']},
            { question : 'オハイネ(ohayne)', answer : ['なるほど', '～できない', '道']},
            { question : 'オラノ(orano)', answer : ['そして', '水', '頭']},
            { question : 'カイエ(kaye)', answer : ['～(単数形)を折る', '～を選ぶ', '熊(=山に住む神)']},
            { question : 'シアマム(siamam)', answer : ['米', '1', '胸']},
            { question : 'シニ(sini)', answer : ['休む', '～を…でいっぱいにする', '鞘']},
            { question : 'スクプ(sukup)', answer : ['言う', '胸', '見る']},
            { question : 'チロンヌプ(cironnup)', answer : ['キツネ', '水', '罰が当たる']},
            { question : 'テレ(tere)', answer : ['～を待つ', '日', '臼']},
            { question : 'トイ(toy)', answer : ['地面', '(単数形が)上がる', '熊(=山に住む神)']},
            { question : 'トペンペ(topenpe)', answer : ['お菓子', 'なるほど', 'あの']},
            { question : 'ヌムケ(numke)', answer : ['～を選ぶ', '嘘をつく', '(単数形が)走る']},
            { question : 'プ(pu)', answer : ['倉', '～を見る', '顔']},
            { question : 'ヘカッタラ(hekattar)', answer : ['子どもたち', '～(単数形)を折る', '眠る']},
            { question : 'ヘメシパ(hemespa)', answer : ['のぼる', '小鳥', 'はずかしい']},
            { question : 'ホシッパ(hosippa)', answer : ['戻る', '地面', '尻']},
            { question : 'ホプンパ(hopunpa)', answer : ['(複数形が)起き上がる', '紙', '頭']},
            { question : 'ホユッパ(hoyuppa)', answer : ['(単数形が)走る', 'エゾリス', '～(複数形)が分かる']},
            { question : 'マ(ma)', answer : ['泳ぐ', '胸', '年']},
            { question : 'ミ(mi)', answer : ['～を着る', '嘘をつく', 'おばあさん']},
            { question : 'モコロ(mokor)', answer : ['眠る', '利尻', '～を大事にする']},
            { question : 'ヤプキリ(yapkir)', answer : ['投げる', '8', '夫婦']},
            { question : 'リキン(rikin)', answer : ['(単数形が)上がる', '難しい', '胴体']},
            { question : 'ルシカ(ruska)', answer : ['～に怒る', '嘘をつく', '腕']},
            { question : 'アシ(asi)', answer : ['立つ', '見る', '眠る']},
            { question : 'アムキリ(amkir)', answer : ['～を知っている', 'ヤマメ', '大きい']},
            { question : 'アラパ(arpa)', answer : ['行く', '干し魚', '～を叩く']},
            { question : 'インカラ(inkar)', answer : ['見る', '～を知っている', 'イヤリング']},
            { question : 'ウパシ(upas)', answer : ['雪', '熊(=山に住む神)', '～の味がする']},
            { question : 'ウムレク(umurek)', answer : ['夫婦', '(単数形が)上がる', 'イヤリング']},
            { question : 'エイワンケ(eywanke)', answer : ['～を使う', '尻', '～(複数形)を開ける']},
            { question : 'エカシ(ekas)', answer : ['祖父', '火', '紙']},
            { question : 'エレム(ermu)', answer : ['ネズミ', '熊(=山に住む神)', '年']},
            { question : 'カラ(kar)', answer : ['～を作る', '(単数形が)走る', '毎年']},
            { question : 'ク(ku)', answer : ['飲む', '見る', '10']},
            { question : 'クンネチュプ(kunnecup)', answer : ['月', '～(単数形)を開ける', '舟']},
            { question : 'コタン(kotan)', answer : ['村', '～を知らない', '～と一緒に']},
            { question : 'コロ(kor)', answer : ['～を持つ', 'なぞなぞする', '6']},
            { question : 'サ(sa)', answer : ['姉', '～を着る', 'カタクリ']},
            { question : 'シノッ(sinot)', answer : ['遊ぶ', '日', '立つ']},
            { question : 'ス(su)', answer : ['鍋', '6', '～を大事にする']},
            { question : 'チクニ(cikuni)', answer : ['木', '～を背負う', 'スズメ']},
            { question : 'チュプ(cup)', answer : ['太陽', '～を盗む', '～を彫る']},
            { question : 'テエタ(teeta)', answer : ['昔', '6', '地面']},
            { question : 'ニサッタ(nisatta)', answer : ['明日', '～(単数形)を開ける', 'お母さん(呼ぶとき)']},
            { question : 'ヌ(nu)', answer : ['～を聞く', '～を取る', 'あの']},
            { question : 'ヌカラ(nukar)', answer : ['～を見る', '～を…でいっぱいにする', '罰が当たる']},
            { question : 'パ(pa)', answer : ['年', '法律・規則', '戻る']},
            { question : 'ホン(hon)', answer : ['腹', '美味しい', 'トリカブト']},
            { question : 'マカ(maka)', answer : ['～(単数形)を開ける', '米', '～を作る']},
            { question : 'マクパ(makpa)', answer : ['～(複数形)を開ける', 'ウサギ', '昔']},
            { question : 'マッネポ(matnepo)', answer : ['娘', 'ウサギ', '～を大事にする']},
            { question : 'ユク(yuk)', answer : ['シカ', '胸', '明日']},
            { question : 'レラ(rera)', answer : ['風', '～を叩いて刻む', '姉']},
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
            // 本番環境では先頭に..をつける。
            post("../ainu01/ainu01_today_challenge/update", results)
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
            }, 1500);
        });
        //もう一度挑戦するを押した時の処理
        quizArea.on('click', '.quiz_restart', function(){
            quizReset();
        });
        //もう一度挑戦するを押した時の処理
        quizArea.on('click', '.quiz_onemore', function(){
            quizOnemore();
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
        function quizOnemore(){
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
            window.location.href = '/ainu01/ainu01_today_challenge';
        }
        //結果を表示する関数
        function quizResult(){
            quizArea.find('.quiz_set').hide();
            var quiz_pt = quiz_success_cnt*10;
            var text = quiz_fin_cnt + '問中' + quiz_success_cnt + '問正解！' + quiz_pt + 'pt 獲得！';
            results["quiz_point"] = quiz_pt;
            // 本番環境では先頭に..をつける。
            post("../ainu01/ainu01_today_challenge/update", results);
            if(quiz_fin_cnt === quiz_success_cnt){
                text += '<br>全問正解おめでとう！';
                quiz_fin_cnt + 'pt 獲得！';
            }
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
    async function post(url, results) {
        fetch(url, {
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
