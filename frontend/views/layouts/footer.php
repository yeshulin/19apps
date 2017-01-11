  <?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

?>
<div class="sobey_right_fixed">
    <!-- <div>
        <a target="_blank" class="sobey_right_fixed_android sobey_right_fixed_not" href="/list-387-1.html"></a>
        <div class="sobey_right_fixed_android_img">
            <img src="/apk/android.png" width="127" height="127" alt=""/>
        </div>
    </div> -->
    <div style="margin-top: 0px;">
        <a target="_blank" class="sobey_right_fixed_cart" href="<?=URL::to("/site/order/cart")?>"></a>
    </div>
    <div style="margin-top: 4px;">
        <a target="_blank" class="sobey_right_fixed_kefu" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1665529834&amp;site=学院客服&amp;menu=yes"></a>
    </div>
    <div style="margin-top: 4px;">
        <a target="_blank" class="sobey_right_fixed_weixin sobey_right_fixed_not" href="javascript:void(0);"></a>
        <div class="sobey_right_fixed_weixin_img"></div>
    </div>
    <div style="margin-top: 4px;">
        <a class="sobey_right_fixed_dingbu" style="visibility: hidden;" href="#"></a>
    </div>
</div>

  <div>
		<div class="inner">
		<div class="clearfix">
			<div class="l footer-left">
				<p><em>热门商品:</em><a href="<?=Url::to("/site/lab")?>">云端实验室</a><a href="<?=Url::to("/site/practical")?>">企业实训</a><a href="<?=Url::to("/site/live")?>">教育直播服务</a></p>
				<p><em id="Link3">友情链接:</em></p>
<!--					<a href="#">华栖云官网</a>-->
<!--					<a href="#">阿里云官网</a>-->
<!--					<a href="#">索贝媒体云</a>-->
				
				<p><em>关于我们:</em><a href="<?= Url::to(['/site/site/introduce'])?>">学院介绍</a><a href="<?= Url::to(['/site/site/contact'])?>">联系我们</a></p>
					<!--<a href="#">加入我们</a>-->
					
				
			</div>
			<div class="r footer-right">
				<img class="r" height="102" width="102" src="<?=Url::to('@web/mlv/img/temp/ewm.png', true)?>" alt="">
				<div class="r text-right" style="margin-right: 10px;">
					<p style="color: #e76f45;">扫一扫，关注华栖云教官方订阅号</p>
					<div class="footer-icon clearfix" style="margin-top: 28px;">
					<div class="r">
						<span style="margin-right: 15px;"></span>
						<a href="#"><img src="<?=Url::to('@web/mlv/img/icon/footer-icon1.png', true)?>" alt=""></a>
						<a href="#"><img src="<?=Url::to('@web/mlv/img/icon/footer-icon2.png', true)?>" alt=""></a>
						<span style="margin-left: 15px;"></span>
					</div>
					
					</div>
					<p style="color: #4b505d;margin-top: 10px;">客服热线：<span style="color: #9da4bc;">028-85157553</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;每天9:30-18:30&nbsp;&nbsp;(法定节假日除外)</p>
				</div>

			</div>
			</div>

			<div style="border-top: 1px dashed #404452;height: 53px;line-height: 53px;color: #4c505e;">
				<p class="text-center f14"><span class="f16" style="color:#697088;">成都华栖云科技有限公司</span>&nbsp;<span style="font-size:14px;color:#697088;">Copyright  2016, hqyunjiao.com, All Rights Reserved </span>  </p>
			</div>
		</div>

  </div>
  <?php
    $this->registerJsFile('@web/mlv/js/data/2e4d25ce0d2c81d9eb1baa01e95f148c.js');
  ?>
  <script type="text/javascript">
    $(function(){
        $.each(Link3, function(k, v){
            $("#Link3").after('<a target="_blank" href="'+ v.url+'">'+ v.name+'</a>');
        })
        $(window).scroll(function(){
            if($(window).scrollTop() == 0){
                $(".sobey_right_fixed_dingbu").css("visibility","hidden");
            }else{
                $(".sobey_right_fixed_dingbu").css("visibility","visible");
            }
        })
        $(".sobey_right_fixed > div > a").hover(function(){
            var objThis = $(this);
            if(!objThis.hasClass("sobey_right_fixed_not")){
                objThis.stop().animate({"width":"138px"},300);
            }

        },function(){
            var objThis = $(this);
            if(!objThis.hasClass("sobey_right_fixed_not")){
                objThis.stop().animate({"width":"50px"},300);
            }
        });
        $(".sobey_right_fixed_weixin").hover(function(){
            $(".sobey_right_fixed_weixin_img").stop().fadeIn(300);
        },function(){
            $(".sobey_right_fixed_weixin_img").stop().fadeOut(300);
        });
        $(".sobey_right_fixed_android").hover(function(){
            $(".sobey_right_fixed_android_img").stop().fadeIn(300);
        },function(){
            $(".sobey_right_fixed_android_img").stop().fadeOut(300);
        });
        var page_box_width = 0;
        $(".pages").children("span,a").each(function(){
            var that =$(this);
            page_box_width += (that.width()+10);
        });
        $(".pages").width(page_box_width+"px");
        $(".pages").css("margin-top","30px");
    });
</script>
<div style="display:none" id="cnzztongjie"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260196398'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1260196398' type='text/javascript'%3E%3C/script%3E"));</script></div>
