<a href="/?index=1"><img src="/image/logo.png" alt="" id="logo"></a>
    <img src="/image/menu.png" alt="" id="menu">
    @if($userLogin != null)
        @if($icon['0'] < 7)

            @if($icon['0'] == 0)
                <a href="/user_data"><span class="icon icon_bk1">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 1)
                <a href="/user_data"><span class="icon icon_bk2">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 2)
                <a href="/user_data"><span class="icon icon_bk3">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 3)
                <a href="/user_data"><span class="icon icon_bk4">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 4)
                <a href="/user_data"><span class="icon icon_bk5">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 5)
                <a href="/user_data"><span class="icon icon_bk6">{{$icon['1']}}</span></a>
            @elseif($icon['0'] == 6)
                <a href="/user_data"><span class="icon icon_bk7">{{$icon['1']}}</span></a>
            @endif
        @endif
    @else
    <a href="/new"><img src="/image/user.png" alt="" class="icon"></a>
    @endif