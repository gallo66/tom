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
<body id="other">
    <header>
        <div  id="header" class="container">
            @yield('logo')            
        </div>
    </header>
    <div id="contents">        
        <div id="main">
            @yield('main')             
        </div>
        <div id="nav" class="navSlide">
            @yield('nav')
        </div>       
    </div>    

    <script src="/js/script.js"></script>
</body>
</html>