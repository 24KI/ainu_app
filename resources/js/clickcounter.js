function click_event() {
    //日時情報を取得
    var date = new Date();

    //ローカルストレージに保存されているデータを取得
    var data = localStorage.date_flg;

    if (Number(data) != date.getDate()) {
        //ローカルストレージの中身と今日の日付が一致しなかった場合
        localStorage.date_flg = date.getDate();
    } else {
        //ローカルストレージの中身と今日の日付が一致した場合
        //つまり、１日に２回以上押した場合
        alert("挑戦できる回数は1日1回までです。");
    }
}
