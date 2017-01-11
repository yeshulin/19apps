/**
 * Created by TiCapsule_ on 2016/8/3.
 */
$(function(){
    
    var member = new memberCommon();
    if(userInfo != null){
            var data = [
          {
            "logined":true,
            "name": userInfo.username,
            "nickname": userInfo.nickname            
          }
             ];
        }else{
             var data = [
          {
             "logined":false
          }
             ];
        }    

        var template = $.templates("#headerTmpl");

        var htmlOutput = template.render(data);

        $("#header-box").html(htmlOutput);
        $(".header-logo img").eq(0).attr("src", urlPre+"/mlv/img/index/logo-index.png");


   //首页头部js 
    $(".header-nav li").removeClass("act");
    var swiper = new Swiper('.swiper-container', {
        //pagination: '.swiper-pagination',
        // paginationClickable: true,
        speed:1,
        loop:true,
        preventClicks: false,
        preventClicksPropagation: false,
        onSlideChangeStart:function(swiper){  
            var h_num = swiper.activeIndex;
             if( h_num > 1&& h_num<=7){
                    $(".header-nav li:eq("+(h_num-2)+")").addClass("act").siblings().removeClass("act");   
                 }
                 else if(h_num==0){
                    $(".header-nav li:eq(5)").addClass("act").siblings().removeClass("act"); 
                  }
                 else{
                    $(".header-nav li").removeClass("act");
                  }
                  $(".fadeInRight").removeClass("fadeInRight");
                  $(".fadeInLeft").removeClass("fadeInLeft");
                  $(".fadeInUp").removeClass("fadeInUp");
                  $(".fadeInRight").removeClass("fadeInRight");
                  $(".flipInY").removeClass("flipInY");
                  $(".zoomIn").removeClass("zoomIn");
                  $(".bounceInLeft").removeClass("bounceInLeft");
                  // $(".pulse").removeClass("pulse");
                  $(".swiper-slide .index-rengzhengP").removeClass("animated fadeInRight")
                  $(".swiper-slide-active .index-xuexi-bot>div,.swiper-slide-active .r").addClass("animated fadeInRight");
                  $(".swiper-slide-active .index-zhibo-bot>div,.swiper-slide-active .index-shixun-img02").addClass("animated fadeInUp");
                  $(".swiper-slide-active .index-shiyanshi-bot>div,.swiper-slide-active .index-rengzheng-bot").addClass("animated fadeInLeft");
                  $(".swiper-slide-active .index-swiper-top h1").addClass("pulse animated");
                  $(".swiper-slide-active .l").addClass("animated fadeInLeft");
                  $(".swiper-slide-active .index-shixun-img").addClass("animated bounceInLeft")
                  $(".swiper-slide-active .index-rengzhengP ").addClass("animated flipInY");
                  $(".swiper-slide-active .index-zhibo-img ").addClass("animated zoomIn");
                  $(".swiper-slide-active .index-yunjiao-bot").addClass("animated fadeInUp");
                  $(".swiper-slide-active .yunjiao-img").addClass("animated flipInY");
                  
          }
    });
 
        $(".header-logo").hover(function(){
               swiper.slideTo(1,1, true);
            });
        $(".header-nav li").hover(function(){
            var index = $(this).index(); 
            swiper.slideTo(index+2,1, true); 
                       
      });
        $('.content-main-box').mousewheel(function(event, delta) {
          console.log( delta);
          if(delta==1){
             swiper.slidePrev();
          }else{
            swiper.slideNext();
          }




          event.preventDefault();
    });







    $("header").on("click","#user-logout",function(){
        member.logout(function(result){
            if(result.msg=="success"){
                alert("退出成功!");
                window.location.reload();
            }
        });
    });
    
    
})