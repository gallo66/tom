@extends('layouts.ka2Detail')

@section('title','ka2oo')

@section('logo')
    @include('conponents.icon')
@endsection

@section('main')
    <div id="thumbnail">
        <img src="/image/image_{{$content->id}}.png" alt="" id="play" data-message_id="{{$content->id}}">
        <p id="Youtube">Youtube</p>
    </div>
    @parent
    <div class="item">
        <div class="movie_center">
            <iframe src="{{$content->url}}?enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="detail_movie"></iframe>
        </div>
        <p id="movie_come">{{$content->comment}}</p>
        @if($userLogin == null)
        <p id="accessory"><span ><img src="\image\good_1.png" alt="" class="good_btn"></span><span id="count">{{$count}}</span></p>
        <p id="user_come">コメントの入力にはログイン（新規登録）をお願いします</p>
        @else
        <p id="accessory">
        @if($good == null)
        <a  class="js-goodButton" data-message_id="{{$content->id}}"><span ><img src="/image/good_1.png" alt="" class="good_btn good"></span><span id="count">{{$count}}</span></a>
        @else
        <a  class="js-goodButton" data-message_id="{{$content->id}}"><span ><img src="/image/good_2.png" alt="" class="good_btn good"></span><span id="count">{{$count}}</span></a>
        @endif

        @if($recommend == null)
        <a class="js-favoriteButton" data-message_id="{{$content->id}}"><span><img src="/image/heart_1.png" alt="" class="good_btn heart"></span></a>
        @else
        <a class="js-favoriteButton" data-message_id="{{$content->id}}"><span><img src="/image/heart_2.png" alt="" class="good_btn heart"></span></a>
        @endif
        </p>
        @isset($come)
        <span class="come_null">{{$come}}</span>
        @endisset
        <div id="form_come">
            <form action="/put" method="post">
                @csrf
                <span id="user_name">{{$userLogin->login}}さん</span>
                <input type="hidden" name="id" value="{{$content->id}}">
                <textarea name="comment" class="input_css"></textarea>
                <input type="submit" value="投稿" class="submit_css">
            </form>
        </div>
        @endif
        <hr>
        <div class="user_come">
                @each('conponents.commentsConponent',$comments,'come')
        </div>
    </div>
@endsection

@section('nav')
    @include('conponents.link_detail')
@endsection






