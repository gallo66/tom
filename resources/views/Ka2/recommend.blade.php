@extends('layouts.ka2Serch')

@section('title','お気に入り')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')

    @parent
    <h1>{{$userLogin['login']}}さんのお気に入り</h1>
    <hr>
    @each('conponents.recommendConponent',$recommend,'item')
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






