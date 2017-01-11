/**
 * Created by TiCapsule_ on 2016/8/3.
 */
$(function(){
    function headerInit(){
        var _goal = $(".header-nav li.act");
        var _left = _goal[0].offsetLeft;
        var _obj = $(".header-nav > div");
        var _width = _goal.width();
        _obj.width(_width+"px");
        _obj.stop().animate({"left":_left+"px"},0);
    }
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

   
    $(".header-nav li").on("mouseenter",function(){
        var objThis = $(this);
        $(".header-nav li").removeClass("act");
        objThis.addClass("act");
        headerInit();
         
    });
    $(".header-nav li").on("mouseleave",function(){
        $(".header-nav li").removeClass("act");
		if($(".header-nav li[tag]")[0]){
				$(".header-nav li[tag]").addClass("act");
		}else{
			var _obj = $(".header-nav > div");
			_obj.width("0px");
		}
        
        headerInit();
    });
    $("header").on("click","#user-logout",function(){
        member.logout(function(result){
            if(result.msg=="success"){
                sobeyAlert("退出成功!",function(){
                  window.location.reload();
                });
            }
        });
    });
    $(".header-nav li a").each(function(i,obj){
        var objThis = $(obj);
        var _navStr = window.location.href.split("/");
        var _Ahref = obj.href.split("/");
        if(_Ahref[_Ahref.length -1] == _navStr[_navStr.length-1]){
             $(".header-nav li").removeClass("act");
              $(".header-nav li").removeAttr("tag");
            objThis.parent().addClass("act");
            objThis.parent().attr("tag","");
        }
    });
     headerInit();
     var min_height = $(window).height()-94;
     $(".content-main-box").css("min-height",min_height);
     $(".content-main-box").css("min-height",document.documentElement.clientHeight-304+"px");     
})