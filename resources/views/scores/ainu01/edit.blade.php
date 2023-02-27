@extends('layouts.frame')
@section('content')
@include('commons.errors')

<form action="{{ route('ainu01.update', $score->id) }}" method="post">
    @method('patch')
    @include('scores.ainu01.form')
    <button type="submit">更新する</button>
    <a href="{{ route('ainu01.show', $score->id) }}">キャンセル</a>
</form>

@endsection()
