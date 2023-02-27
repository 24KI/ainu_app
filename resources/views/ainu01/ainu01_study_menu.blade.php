@extends('layouts.ainu01_frame')
@section('content')

<style type="text/css">
    .sidebar-content {
        margin: 0 auto;
    }
</style>

<div class="top-head">
    <h1>アイヌ語講座 レベル選択</h1>
</div>
<div align="center">
    <a href="{{ url('/ainu01/ainu01_study_1') }}"><img src="/ainu01/image/1.png"></a>
    <a href="{{ url('/ainu01/ainu01_study_2') }}"><img src="/ainu01/image/2.png"></a>
    <a href="{{ url('/ainu01/ainu01_study_3') }}"><img src="/ainu01/image/3.png"></a>
    <a href="{{ url('/ainu01/ainu01_study_4') }}"><img src="/ainu01/image/4.png"></a>
    <a href="{{ url('/ainu01/ainu01_study_5') }}"><img src="/ainu01/image/5.png"></a>
</div>
