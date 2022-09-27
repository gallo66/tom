
<div class="item">
    <div class="img_center">
        <h3>{{$item->title}}</h3>
        <a href="/detail?id={{$item->content_id}}"><img src='/image/image_{{$item->content_id}}.png' alt="" class="thumbnail"></a>
        <a href="/detail?id={{$item->content_id}}"><video  preload="auto" src="\movie\short_{{$item->content_id}}.mp4" class="short short_recommend" loop autoplay muted></video></a>
    </div>
    <p>{{$item->content->comment}}<br><br>：{{(string)$item->now_time->format('Y年m月d日')}}</p>
</div>
<hr>