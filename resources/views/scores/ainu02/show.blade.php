@extends('layouts.frame')
@section('content')

<score class="score-detail">

    <div class="score-info">作成日時: {{ $score->created_at }}</div>
    <div class="score-info">クイズタイプ: {{ $score->type }}</div>
    <div class="score-question">第1問: {{ $score->question1 }}</div>
    <div class="score-question">第2問: {{ $score->question2 }}</div>
    <div class="score-question">第3問: {{ $score->question3 }}</div>
    <div class="score-question">第4問: {{ $score->question4 }}</div>
    <div class="score-question">第5問: {{ $score->question5 }}</div>
    <div class="score-question">第6問: {{ $score->question6 }}</div>
    <div class="score-question">第7問: {{ $score->question7 }}</div>
    <div class="score-question">第8問: {{ $score->question8 }}</div>
    <div class="score-question">第9問: {{ $score->question9 }}</div>
    <div class="score-question">第10問: {{ $score->question10 }}</div>
    <div class="score-total">正解数: {{ $score->quiz_success_count }}</div>

    <div class="score_control">
        <a href="{{ route('ainu01.edit', $score->id) }}">編集</a>
        <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('ainu02.destroy', $score->id) }}"
              method="post">
            @csrf
            @method('delete')
            <button type="submit">削除</button>
        </form>
    </div>
</score>

@endsection
