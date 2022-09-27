@extends('layouts.ka2Home')

@section('title','ka2oo')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')

    @parent
    @each('conponents.mainConponent',$data,'item')
@endsection

@section('nav')
    @include('conponents.link')
@endsection






