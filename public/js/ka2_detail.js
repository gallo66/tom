const $doc    = document;
const $header = $doc.getElementsByTagName('header');
const $move   = $doc.getElementsByTagName('video');
const $top_movie  = $doc.getElementById('video');
const $menu   = $doc.getElementById('menu');
const $home   = $doc.getElementById('home');
const $nav    = $doc.getElementById('nav');
const $main   = $doc.getElementById('main');
const $search = $doc.getElementById('search');
const colors  = ['#F24535','#011140','#044BD9','#297343','#F2C849'];
const $play   = document.getElementById('play');

const TopPage = ()=>{

    $(function(){

        $('#home .container').fadeIn(1000);
        $('#home').css('background','black');
        $('header').css('background','rgba(255,255,255,0.8)');
    });
}

const TopMovie = ()=>{

    $(function(){
        $('#video').fadeOut(1000);
    });
}




    setTimeout(TopMovie);
    setTimeout(TopPage,500);    


if($top_movie != null){

    $top_movie.addEventListener("ended", function()
        {
            console.log($top_movie);
            init();
        }, false);
}else{
    $('#home').css('background','black');
    $('header').css('background','rgba(255,255,255,0.8)');

}

$menu.onclick = ()=>{
    $nav.classList.toggle('navSlide');
}


$(function(){

    $('#play,#Youtube').click(function() { 

        const $id = $play.dataset.message_id;    

        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/history_put/'+$id,
            type: 'GET', // POSTかGETか
            success: function() {       

                const targetWindow = $doc.getElementById('detail_movie').contentWindow;

                const ag2ytControl = function(action,arg=null){
                    targetWindow.postMessage('{"event":"command", "func":"'+action+'", "args":'+arg+'}', '*');
                };
            
                ag2ytControl('playVideo');
                $('#play').fadeOut();

            },
            error: function() {
                //通信が失敗した場合の処理をここに書く
            }
        });
    });


    $('.img_center').hover(function(){    
        $(this).find($('.thumbnail')).css('opacity','0');
        $(this).find($('.short')).fadeIn();
      },function(){
        $(this).find($('.thumbnail')).css('opacity','1.0');
        $(this).find($('.short')).fadeOut();
    });

    $('#search').click(function(){    
        $(this).toggleClass("searchBk");

        console.log('クリック')

        if($('#form_search').hasClass('active')){
            $('#form_search').slideUp(500);
            $('#form_search').removeClass('active');          
        }else{
            $('#form_search').css('display','inline-block');
            $('#form_search').slideDown();
            $('#form_search').addClass('active');
        }
    });  


    $('.js-goodButton').click(function() {
        // いいねしたメッセージのidを取得する
        var id = $(this).data('message_id');
        var index;
        var img_g = $('.good_btn').attr('src');

        if(img_g == "/image/good_1.png"){
            index = 0;
        }else{
            index = 1;
        }

        // Ajax通信
        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/like/'+id+'/'+index,
            type: 'GET', // POSTかGETか
            success: function() {           
            
                    if(index == 0){

                        var id = $('#count').text();
                        id ++;
                        $('#count').text(id);               
                        var i = $('.good').attr('src');
                        i = "/image/good_2.png";
                        $('.good').attr('src',i);
                    }else{

                        var id = $('#count').text();
                        id --;
                        $('#count').text(id);               
                        var i = $('.good').attr('src');
                        i = "/image/good_1.png";
                        $('.good').attr('src',i);
                    }
            },
            error: function() {
                //通信が失敗した場合の処理をここに書く
            }
        });
    });

    $('.js-favoriteButton').click(function() {
        // いいねしたメッセージのidを取得する
        var id = $(this).data('message_id');
        var index;
        var img_g = $('.heart').attr('src');

        if(img_g == "/image/heart_1.png"){
            index = 0;
        }else{
            index = 1;
        }

        // Ajax通信
        $.ajax({
            headers: {
                // csrf対策
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/favorite/'+id+'/'+index,
            type: 'GET', // POSTかGETか
            success: function() {           
            
                    if(index == 0){
          
                        var i = $('.heart').attr('src');
                        i = "/image/heart_2.png";
                        $('.heart').attr('src',i);
                    }else{

                        var i = $('.heart').attr('src');
                        i = "/image/heart_1.png";
                        $('.heart').attr('src',i);
                    }
            },
            error: function() {
                //通信が失敗した場合の処理をここに書く
            }
        });
    });



});

