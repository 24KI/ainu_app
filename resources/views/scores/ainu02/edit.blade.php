@extends('layouts.frame')
@section('content')
@include('commons.errors')

<form action="{{ route('ainu02.update', $score->id) }}" method="post">
    @method('patch')
    @include('scores.ainu02.form')
    <button type="submit">更新する</button>
    <a href="{{ route('ainu02.show', $score->id) }}">キャンセル</a>
</form>

@endsection()
