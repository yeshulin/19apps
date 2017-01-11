    <?php
    use yii\helpers\url;
    ?>
<?php 
	$this->registerCssFile('@web/mlv/css/member.css');
?>

<div class="user-left">
	<dl>
		<dt>
			<i class="pen-icon"></i>
			<span>我的学习</span>
		</dt>
		<dd>
			<p><a class="act" href="<?=Url::to("/user/default/mycourse")?>">我的课程</a></p>
			<!--<p><a  href="<?=Url::to("/user/default/myquestion")?>">我的提问</a></p>-->
			<!--<p><a href="#">我的考试</a></p>-->
		</dd>
	</dl>
	<dl>
		<dt>
		<!--
		<i class="medal-icon"></i>
			<span>我的认证</span>
		</dt>
		<dd>
			<p><a href="#">报考记录</a></p>
			<p><a href="#">企业认证</a></p>			
		</dd>
	</dl>	
	<dl>
		<dt>
		-->
			<i class="file-icon"></i>
			<span>我的服务</span>
		</dt>
		<dd>
			<p><a href="<?=Url::to("/user/practical/index")?>">我的实训</a></p>
			<p><a href="<?=Url::to("/user/lab/index")?>">我的实验室</a></p>
			<p><a href="<?=Url::to("/user/live/index")?>">我的直播</a></p>
		</dd>
	</dl>	
	<dl>
		<dt>
			<i class="shopcar-icon"></i>
			<span>我的订单</span>
		</dt>
		<dd>
			<p><a href="<?=Url::to(['/user/order/list'])?>">订单列表</a></p>
		</dd>
	</dl>
	<dl>
		<dt>
			<i class="shopcar-icon"></i>
			<span>账户管理</span>
		</dt>
		<dd>
			<p><a href="<?=Url::to(['/user/info/edit'])?>">资料修改</a></p>
			<p><a href="<?=Url::to(['/user/info/pwd'])?>">密码修改</a></p>
			<p><a href="<?=Url::to(['/user/info/renzheng'])?>">我的认证</a></p>
			<p><a href="<?=Url::to(['/user/address/index'])?>">收货地址管理</a></p>
			<p><a href="<?=Url::to(['/user/activation/index'])?>">激活码</a></p>
			<p><a href="<?=Url::to(['/user/message/index'])?>">站内信</a></p>
		</dd>
	</dl>
	<dl>
		<dt>
			<i class="shopcar-icon"></i>
			<span>服务中心</span>
		</dt>
		<dd>
			<p><a href="<?=Url::to(['/user/feedback/index'])?>">意见反馈</a></p>
			<p><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=1665529834&amp;site=索贝学院"  target="_blank">联系我们</a></p>
		</dd>
	</dl>

</div>
<script type="text/javascript">
	$(function(){
		$(".user-left p a").each(function(i,obj){
			
        var objThis = $(obj);
        var _navStr = window.location.href;
        var _Ahref = obj.href;      
        if(_Ahref == _navStr){
             $(".user-left p a").removeClass("act");              
            objThis.addClass("act");
        }
    });
	});
</script>