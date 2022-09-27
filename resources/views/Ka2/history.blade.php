@extends('layouts.ka2Serch')

@section('title','視聴履歴')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')

    @parent
    <h1>{{$userLogin['login']}}さんの視聴履歴</h1>
    <hr>
    @each('conponents.historyConponent',$history,'item')
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






