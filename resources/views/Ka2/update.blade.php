@extends('layouts.ka2Other')

@section('title','登録内容変更')

@section('logo')
  @include('conponents.icon')
@endsection

@section('main')
    @parent

    <form action="update" method="post">
        @csrf
        <h1>登録内容変更</h1>
        
        @error('login')
        <p class="error">    {{$message}}</p>    
        @enderror
        @if(isset($userLogin))
        <p><span>ユーザー名</span><input type="text" name="login" value="{{$userLogin['login']}}" required></p>
        @else
        <p><span>ユーザー名</span><input type="text" name="login" value="{{old('login')}}" required></p>
        @endif

        @error('mail')
        <p class="error">    {{$message}}</td></tr>    
        @enderror
        @if(isset($userLogin))
        <p><span>メールアドレス</span><input type="email" name="mail" value="{{$userLogin['mail']}}" required></p>
        @else
        <p><span>メールアドレス</span><input type="email" name="mail" value="{{old('mail')}}" required></p>
        @endif
        
        @error('password')
        <p class="error">    {{$message}}</p>    
        @enderror
        @if(isset($userLogin))
        <p class="pass"><span>パスワード</span><input type="password" name="password" value="{{$userLogin['password']}}" required></p>  
        @else
        <p class="pass"><span>パスワード</span><input type="password" name="password" value="{{old('password')}}" required></p>  
        @endif
        <p class="pass_com">※英大・小・数字を各１文字含む８文字以上で入力してください</p>  
    
        @error('repassword')
        <p class="error">    {{$message}}</p>    
        @enderror
        <p><span>パスワード(確認用)</span><input type="password" name="repassword" required></p>
        <p><input type="submit" value="登録内容変更"><a href="/del" class="dalete">退会する</a></p>
    </form>
    
@endsection

@section('nav')
    @include('conponents.link_other')
@endsection






