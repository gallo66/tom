
<div class="item">
    <div class="img_center">
        <h3>{{$item->title}}</h3>
        <a href="/detail?id={{$item->id}}"><img src='/image/image_{{$item->id}}.png' alt="" class="thumbnail"></a>
        <a href="/detail?id={{$item->id}}"><video  preload="auto" src="\movie\short_{{$item->id}}.mp4" class="short" loop autoplay muted></video></a>
    </div>
    <p>{{$item->comment}}</p>
</div>
<hr>