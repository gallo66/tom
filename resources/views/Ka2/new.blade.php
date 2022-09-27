@extends('layouts.ka2Other')

@section('title','新規登録')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')
    @parent

    <form action="new" method="post" id="form_new">
        @csrf
        <h1>新規登録</h1>
        
        @error('login')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p><span>ユーザー名</span><input type="text" name="login" value="{{old('login')}}" required></p>
        @error('mail')
        <p class="error">    {{$message}}</td></tr>    
        @enderror
        <p><span>メールアドレス</span><input type="email" name="mail" value="{{old('mail')}}" required></p>
        @error('password')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p class="pass"><span>パスワード</span><input type="password" name="password" value="{{old('password')}}" required></p>  
        <p class="pass_com">※英大・小・数字を各１文字含む８文字以上で入力してください</p>  
        @error('repassword')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p><span>パスワード(確認用)</span><input type="password" name="repassword" required></p>
        <p><input type="submit" value="新規登録"></p>
    </form>
    
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






