@csrf
<dl class="form-list">
    <dt>クイズタイプ</dt>
    <dd><input type="text" name="type" value="{{ old('type', $score->type) }}"></dd>
    <dt>第1問</dt>
    <dd><input type="number" name="question1" value="{{ old('question1', $score->question1) }}"></dd>
    <dt>第2問</dt>
    <dd><input type="number" name="question2" value="{{ old('question2', $score->question2) }}"></dd>
    <dt>第3問</dt>
    <dd><input type="number" name="question3" value="{{ old('question3', $score->question3) }}"></dd>
    <dt>第4問</dt>
    <dd><input type="number" name="question4" value="{{ old('question4', $score->question4) }}"></dd>
    <dt>第5問</dt>
    <dd><input type="number" name="question5" value="{{ old('question5', $score->question5) }}"></dd>
    <dt>第6問</dt>
    <dd><input type="number" name="question6" value="{{ old('question6', $score->question6) }}"></dd>
    <dt>第7問</dt>
    <dd><input type="number" name="question7" value="{{ old('question7', $score->question7) }}"></dd>
    <dt>第8問</dt>
    <dd><input type="number" name="question8" value="{{ old('question8', $score->question8) }}"></dd>
    <dt>第9問</dt>
    <dd><input type="number" name="question9" value="{{ old('question9', $score->question9) }}"></dd>
    <dt>第10問</dt>
    <dd><input type="number" name="question10" value="{{ old('question10', $score->question10) }}"></dd>
    <dt>正解数</dt>
    <dd><input type="number" name="quiz_success_count" value="{{ old('quiz_success_count', $score->quiz_success_count) }}"></dd>
</dl>
