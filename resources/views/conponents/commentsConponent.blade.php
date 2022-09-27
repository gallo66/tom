


    @php

        $icon = $come->person->icon;
        $icon_name = "";

        if($icon < 7){
            if(preg_match('/^[a-zA-Z0-9]+$/',$come->person->login) || preg_match('/[^!#<>:;&~@%+$"\'\*\^\(\)\[\]\|\/\.,_-]/',$come->person->login)){
                if(preg_match('/^[ａ-ｚＡ-Ｚ０-９]+$/',$come->person->login)){
                    $icon_name = mb_substr($come->person->login,0,1);
                }else{
                    $icon_name = substr($come->person->login,0,1);
                }
            }else{
                $icon_name = mb_substr($come->person->login,0,1);
            }
        }


    @endphp

    <table>       
        <tr>
            <td>
                @if($icon < 7)

                    @if($icon == 0)
                    <span class="user_name icon_bk1">{{$icon_name}}</span>
                    @elseif($icon == 1)
                    <span class="user_name icon_bk2">{{$icon_name}}</span>
                    @elseif($icon == 2)
                    <span class="user_name icon_bk3">{{$icon_name}}</span>
                    @elseif($icon == 3)
                    <span class="user_name icon_bk4">{{$icon_name}}</span>
                    @elseif($icon == 4)
                    <span class="user_name icon_bk5">{{$icon_name}}</span>
                    @elseif($icon == 5)
                    <span class="user_name icon_bk6">{{$icon_name}}</span>
                    @elseif($icon == 6)
                    <span class="user_name icon_bk7">{{$icon_name}}</span>
                    @endif
                @else
                <span class="user_name">ゲ</span>
                @endif
                @if($icon < 7)
                    @if($icon == 0)
                    <span class="come_user text_bk1">{{$come->person->login}}</span>
                    @elseif($icon == 1)
                    <span class="come_user text_bk2">{{$come->person->login}}</span>
                    @elseif($icon == 2)
                    <span class="come_user text_bk3">{{$come->person->login}}</span>
                    @elseif($icon == 3)
                    <span class="come_user text_bk4">{{$come->person->login}}</span>
                    @elseif($icon == 4)
                    <span class="come_user text_bk5">{{$come->person->login}}</span>
                    @elseif($icon == 5)
                    <span class="come_user text_bk6">{{$come->person->login}}</span>
                    @elseif($icon == 6)
                    <span class="come_user text_bk7">{{$come->person->login}}</span>
                    @endif
                @else
                <span class="come_user text_bk8">{{$come->person->login}}</span>
                @endif    
            </td>
            <td>    
                <span class="comment">{{$come->comment}}</span>
            </td>
            <td>
                @if($come->getUser() == $come->person->id)
                    <a href="come_del?come_id={{$come->id}}&id={{$come->content_id}}" class="come_del">削除する</a>
                @else
                    <span class="come_span"></span>
                @endif
            </td>
        </tr>
    </table> 

   



