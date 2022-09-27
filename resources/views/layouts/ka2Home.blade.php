<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>@yield('title')</title>
</head>
<body id="home">
    @if($index == 0)
    <video playsinline autoplay muted src="\movie\topmovie.mp4" class="top_movie" id="video"></video>
    @endif
    
        @if($index == 0)
        <header>
        <div id="header" class="container">       
        @else
        <header>
        <div id="header">       
        @endif
          @yield('logo')            
        </div>
    </header>
    <div id="contents">
        @if($index == 0)
        <div class="container">       
        @else
        <div>       
        @endif
            @section('main')
           
            <div id="main">
                 @show             
            </div>
            @if(@isset($ans) || @isset($history_ans)|| @isset($recommended_ans))
            <div id="nav" >
            @else
            <div id="nav" class="navSlide">
            @endif
                @yield('nav')
            </div>
        </div>       
    </div>    

    <script src="/js/script.js"></script>
</body>
</html>