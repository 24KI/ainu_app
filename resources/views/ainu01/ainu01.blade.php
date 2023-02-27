@extends('layouts.ainu01_frame')
@section('content')

<div class="top-head">
<h1>アイヌ語講座</h1>
</div>

<div class="container">
<div class="row justify-content-center">
    <div class="col-2">
        <table class="sidebar-content">
            <tbody>
            <tr>
                <th scope="row">獲得ポイント</th>
            </tr>
            <tr>
                <td>{{ Auth::user()->status->ainu01_total_quiz_point }} pt </td>
            </tr>
            <tr>
                <th scope="row">練習回数</th>
            </tr>
            <tr>
                <td>{{ Auth::user()->status->ainu01_practice_count }} 回</td>
            </tr>
            <tr>
                <th scope="row">称号</th>
            </tr>
            <tr>
                <td><img src ="/ainu01/image/{{ Auth::user()->status->ainu01_cognomen }}" width="150" height="50"></td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-6">
        <div class="card">
            <img class="bd-placeholder-img card-img-top" width="100" height="100" src="/ainu01/image/calender_himekuri.png" alt="No image">
            <div class="card-body">
                <h5 class="card-title">今日の問題！</h5>
                <p class="card-text">今日のランダム問題に挑戦しよう！</p>
                <p class="card-text"><small class="text-muted">一日一回、ポイントは10倍だ！<br>全レベルからランダムに出るぞ！</small></p>
                <div style="text-align:center;">
                    <a class="btn btn-primary" role="button", onclick="OnTodaysButtonClicked();">挑戦する</a>
                </div>
            </div>
        </div>

        <div class="card-group">
            <div class="card">
                <img class="bd-placeholder-img card-img-top" width="200" height="200" src="/ainu01/image/bunbougu_memo.png" alt="No image">
                <div class="card-body">
                    <h5 class="card-title">学習</h5>
                    <p class="card-text">単語を覚えよう</p>
                    <div style="text-align:center;">
                        <a class="btn btn-primary" href="{{ url('/ainu01/ainu01_study_menu') }}" role="button">勉強する</a>
                    </div>
                </div>
            </div>

            <div class="card text-center">
                <img class="bd-placeholder-img card-img-top" width="200" height="200" src="/ainu01/image/study_check.png" alt="No image">
                <div class="card-body">
                    <h5 class="card-title">確認問題</h5>
                    <p class="card-text">覚えた単語を確認してみよう</p>
                    <a class="btn btn-primary" href="{{ url('/ainu01/ainu01_practice_menu') }}" role="button">挑戦する</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function OnTodaysButtonClicked() {
        // 本番環境では先頭に..をつける。
        post("/ainu01/ainu01_today_challenge/click", {})
    }
    async function post(url, results) {
        // 本番環境では先頭に..をつける。
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(results)
        })
            .then(response => {
                console.log(response.status);
                return response.json();
            })
            .then(json => {
                console.log("json: ", json);
                if (json["playable"] == true) {
                    // 本番環境では先頭に..をつける。
                    location.href = '/ainu01/ainu01_today_challenge';
                }
                else {
                    alert("挑戦できる回数は1日1回までです。");
                }
            })
            .catch(err => console.log(err));
    }
</script>

@endsection()
