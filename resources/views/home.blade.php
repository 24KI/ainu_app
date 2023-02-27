@extends('layouts.frame')
@section('content')
    <h1 class="page-heading">ホーム</h1>
    <p>ようこそ、{{ Auth::user()->name }}さん</p>

    @if (Auth::user()->status->ainu01_enable == true)
    <p><a href="{{ url('/ainu01/ainu01') }}">アイヌ語教材 ver.α</a></p>
    @else
    <p><s>アイヌ語教材 ver.α</s>=> 下の教材をやってね！</p>
    @endif

    @if (Auth::user()->status->ainu02_enable == true)
        <p><a href="{{ url('/ainu02/ainu02') }}">アイヌ語教材 ver.β</a></p>
    @else
        <p><s>アイヌ語教材 ver.β</s>=> 上の教材をやってね！</p>
    @endif
@endsection()
