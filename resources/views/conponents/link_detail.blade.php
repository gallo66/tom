    
    
    <a href="/?index=1"><p>ホーム</p></a>
    @if($userLogin != null)
    <a href="/logout"><p>ログアウト</p></a>
    <a href="/update"><p>登録内容変更</p></a>
    <a href="/recommended"><p>お気に入り</p></a>    
    @if(@isset($history_ans))
    <a href="/history"><p class="searchBk">視聴履歴</p></a>    
    <span class="history_none">{{$history_ans}}</span>
    @else
    <a href="/history"><p>視聴履歴</p></a>    
    @endisset  
    @else
    <a href="detail?detail={{$id}}"><p>ログイン</p></a>
    <a href="detail?detail_new={{$id}}"><p>新規登録</p></a>
    @endif

         