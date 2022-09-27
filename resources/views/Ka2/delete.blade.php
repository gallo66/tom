@extends('layouts.ka2Other')

@section('title','ユーザー確認')

@section('logo')
  @include('conponents.icon')
@endsection

@section('main')
    @parent

    <form action="/" method="post" id="user_data">
        @csrf
        <h1 id="del_h1">{{$userLogin->login}}さん<img src="/image/logo.png" alt="" id="logo_del">を退会されますか？</h1>
      
        <div><a href="/?index=1" class="cancel">キャンセルする</a><a href="/delete" class="dalete">退会する</a></div>
    </form>
    
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






