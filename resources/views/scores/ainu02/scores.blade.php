@foreach ($scores as $score)
    <score class="score-item">
        <div class="score-title"><a href="{{ route('ainu02.show', $score->id) }}">{{ $score->user->name }}</a></div>
        <div class="score-info">
            {{ $score->created_at }}
        </div>
    </score>
@endforeach
