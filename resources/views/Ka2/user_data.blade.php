@extends('layouts.ka2Other')

@section('title','ユーザー登録情報')

@section('logo')
  @include('conponents.icon')
@endsection

@section('main')
    @parent
    
    <form action="update" method="get" id="user_data">
        <h1>{{$userLogin->login}}さんの登録内容</h1>
        @csrf
       
        <table id="user_data_table">
            <tr><td>ユーザー名</td><td>{{$userLogin['login']}}</td></tr>
            <tr><td>メールアドレス</td><td>{{$userLogin['mail']}}</td></tr>
            <tr><td>パスワード</td><td class="secret">{{$userLogin['password']}}</td></tr>
        </table>
        <div><input type="submit" value="登録内容変更を変更する"><a href="/del" class="dalete">退会する</a></div>
    </form>
    
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






