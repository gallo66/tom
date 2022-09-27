@extends('layouts.ka2Serch')

@section('title','ka2oo')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')

    @parent
    <h1>「{{$word}}」の検索結果</h1>
    <hr>
    @each('conponents.serchConponent',$serch,'item')
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






