<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '课程详情';
?>
<div style="padding-top: 40px;">
<form id="goodsForm" method="POST" action="<?=Url::to(['order/confirm'])?>">
	<div class="inner">
		<div class="course-info-box clearfix">
			<div class="l">
				<img src="<?=$data['goods_thumb']?>" alt="">
				<div class="clearfix" >
					<div class="r">
						<div class="bdsharebuttonbox" style="width: 270px;">
		                <span class="font-size14 color-808080">分享至：</span>
		                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">&nbsp;</a>
		                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">&nbsp;</a>
		                <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">&nbsp;</a>
		                <a href="#" onclick="return false;" class="popup_douban" data-cmd="douban">&nbsp;</a>
		                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">&nbsp;</a>
           		 	</div>

					</div>
					<span><i class="icon-heart"></i><em>收藏</em></span>
				</div>

				<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<style>
    .bdshare-button-style0-16 a, .bdshare-button-style0-16 .bds_more{
        float: none!important;
        font-size: 12px!important;
        line-height: 16px!important;
        height: 16px!important;
        margin: 0 0 0 9px!important;
        background: url(<?=Url::to('@web/mlv/img/icon/share.png', true)?>) no-repeat!important;
        cursor: pointer!important;
        padding: 7px 14px!important;
    }
    .bdshare-button-style0-16 .bds_weixin{
        background-position: -4px -3px!important;
    }
    .bdshare-button-style0-16 .bds_tsina{
        background-position: -48px -3px!important;
    }
    .bdshare-button-style0-16 .bds_tqq {
        background-position: -93px -3px!important;
    }
    .bdshare-button-style0-16 .bds_qzone {
        background-position: -182px -3px!important;
    }
    .bdshare-button-style0-16 .popup_douban {
        background-position: -137px -3px!important;
    }
    .bdshare-button-style0-16 .bds_weixin:hover{
        background-position: -4px -38px!important;
    }
    .bdshare-button-style0-16 .bds_tsina:hover{
        background-position: -48px -38px!important;
    }
    .bdshare-button-style0-16 .bds_tqq:hover{
        background-position: -93px -38px!important;
    }
    .bdshare-button-style0-16 .popup_douban:hover{
        background-position: -137px -38px!important;
    }
    .bdshare-button-style0-16 .bds_qzone:hover{
        background-position: -182px -38px!important;
    }
</style>

			</div>
			<div class="r" style="height: 288px;position: relative;">
				<input type="hidden" name="goods[]" value="<?=$data['goods_id']?>">
				<h2><?=$data['goods_name']?></h2>
				<p><?=$data['subtitle']?></p>
				<div style="margin-top: 30px;">
				<?php
				if(!$data['attrs']){
					if($data['money']!=$data['price']){
				?>
					限时促销：
					<span>¥ <em><?=$data['money']?></em></span>
					<font>原价：¥ <?=$data['price']?></font>
				<?php
					} else {
				?>
					价格：
					<span>¥ <em><?=$data['money']?></em></span>
				<?php
					}
				} else {
				?>
					价格：
					<span>¥ <em class="price"><?=$data['goodsAttr'][0]['money']?></em></span>
				<?php
				}
				?>
				
				</div>
				<?php
				if($data['attrs']){
					foreach ($data['attrs'] as $key => $value) {
				?>
					<div>
						<?php
						switch ($key) {
							case 'time':
								echo "购买时长";
								foreach ($value as $k => $vo) {
								?>
									<label>
										<input class="attr" type="radio" name="<?=$data['goods_id']?>_attr[]" value="<?=$vo['uniquekey']?>" price="<?=$vo['money']?>" <?php if($k==0){echo "checked";}?>>
										<?=$vo['name']?>
										<input type="hidden" name="<?=$vo['uniquekey']?>_attr_num" value="1">
									</label>
								<?php }
								break;
							default:
								break;
						}?>
						
					</div>
				<?php }} ?>
				<?php if($data['type']!=1){ ?>
				<div class="num-box">
					购买数量
					<div>
						<i>－</i><input name="<?=$data['goods_id']?>_num" value="1" type="text" readonly><i>＋</i>											
					</div>
				</div>
				<?php }else{ ?>
					<input type="hidden" name="<?=$data['goods_id']?>_num" value="1">
				<?php } ?>
				<div style="bottom: 0;position: absolute;">
					<button class="bt-style1" type="submit" >立即购买</button>
					<button id="addCart" class="bt-style1" type="button" >加入购物车</button>
					<!--(没有合适的配置？戳这里<a href="#" style="color: #e76f45;">联系我们</a>...) -->
				</div>
			</div>

		</div>
	</div>

</div>
</form>

<div style="margin-top: 21px;">
	<div class="inner" style="border: 1px solid #c2c2c2;padding: 20px 37px;">
		<h2 style="font-size: 24px;color: #333333;">热门推荐</h2>
		<div class="course-list-style1 clearfix">
			<dl>
				<dt><a href="#"><img src="<?=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?>" alt=""></a></dt>
				<dd><a href="#">NOVA 10 云非编</a></dd>
			</dl>
			<dl>
				<dt><a href="#"><img src="<?=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?>" alt=""></a></dt>
				<dd><a href="#">NOVA 10 云非编</a></dd>
			</dl>
			<dl>
				<dt><a href="#"><img src="<?=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?>" alt=""></a></dt>
				<dd><a href="#">NOVA 10 云非编</a></dd>
			</dl>
			<dl>
				<dt><a href="#"><img src="<?=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?>" alt=""></a></dt>
				<dd><a href="#">NOVA 10 云非编</a></dd>
			</dl>

		</div>
	</div>
</div>
<div style="margin-top: 20px;margin-bottom: 50px;">
	
	<div class="inner">
		<div data-am-widget="tabs" class="am-tabs am-tabs-default course-descript">
      <ul class="am-tabs-nav am-cf">
          <li class="am-active"><a href="[data-tab-panel-0]">产品概述</a></li>
          <li class=""><a href="[data-tab-panel-1]">购买须知</a></li>
      </ul>
      <div class="am-tabs-bd">
          <div data-tab-panel-0 class="am-tab-panel am-active">
            <?=$data['description']?>
          </div>
          <div data-tab-panel-1 class="am-tab-panel ">
            <?=$data['buyknows']?>
          </div>
      </div>
  </div>
		
	</div>

</div>
<script type="text/javascript">
	$('.attr').click(function(event) {
		$('.price').html($(this).attr('price'));
	});
	$('#addCart').click(function(event) {
		$.ajax({
	        url: "<?=Url::to(['/site/order/cartin'])?>",
	        type: 'post',
	        dataType: 'json',
	        data: $('#goodsForm').serializeArray(),
	        success: function(result){
	            if(result.status==1){
	            	alert('加入购物车成功');
	            }else{
	            	alert(result.msg);
	            }
	        }
    	});
	});
</script>