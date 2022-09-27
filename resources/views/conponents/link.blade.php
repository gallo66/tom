    
    
    <a href="/?index=1"><p>ホーム</p></a>
    @if($userLogin != null)
    <a href="/logout"><p>ログアウト</p></a>
    <a href="/update"><p>登録内容変更</p></a>
    @if(@isset($recommended_ans))
    <a href="/recommended"><p class="searchBk">お気に入り</p></a>   
    <span class="history_none">{{$recommended_ans}}</span>
    @else
    <a href="/recommended"><p>お気に入り</p></a>   
    @endif
    @if(@isset($history_ans))
    <a href="/history"><p class="searchBk">視聴履歴</p></a>    
    <span class="history_none">{{$history_ans}}</span>
    @else
    <a href="/history"><p>視聴履歴</p></a>    
    @endif
    @else
    <a href="/login"><p>ログイン</p></a>
    <a href="/new"><p>新規登録</p></a>
    @endif

    @if(@isset($ans))
    <p id="search" class="searchBk">検索</p>
    <form action="/search" method="post" id="form_search" class="active">
    @else
    <p id="search">検索</p>
    <form action="/search" method="post" id="form_search">
    @endif
        @csrf

        @isset($ans)
            <span class="history_none">{{$ans}}</span>
        @endisset
        <div><input type="text" name="search"></div>
        <div><input type="submit" value="検索"></div>

    </form>        