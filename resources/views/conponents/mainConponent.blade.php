<div class="item">
    <h3>{{$item->title}}</h3>
    <div class="img_center">
        <a href="/detail?id={{$item->id}}"><p><img src='/image/image_{{$item->id}}.png' alt="" class="thumbnail"></p></a>
        <a href="/detail?id={{$item->id}}"><video  preload="auto" src="\movie\short_{{$item->id}}.mp4" class="short" loop autoplay muted></video></a>
    </div>
    <p class="index_movieCome">{{$item->comment}}</p>
</div>