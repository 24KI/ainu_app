@extends('layouts.frame')
@section('content')
    <h1 class="page-heading">管理者ページ</h1>
    <p>ようこそ、{{ Auth::user()->name }}さん</p>
    <p><a href="{{ url('/scores/ainu01') }}">GFありの方</a></p>
    <p><a href="{{ url('/scores/ainu02') }}">GFなしの方</a></p>
@endsection()
