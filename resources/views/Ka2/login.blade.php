@extends('layouts.ka2Other')

@section('title','ログイン')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')
    @parent

    <form action="login" method="post">
        @csrf
        <h1>ログイン</h1>
        @error('login')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p><span>ユーザー名</span><input type="text" name="login" value="{{old('login')}}" required></p>
        @error('password')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p><span>パスワード</span><input type="password" name="password" value="{{old('password')}}" required></p>  
        <p><input type="submit" value="ログイン"></p>
    </form>
    
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






