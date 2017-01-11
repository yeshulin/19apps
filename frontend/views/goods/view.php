<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\site\Lib\Helper;

/* @var $this yii\web\View */

$this->title = '商品详情';
$this->registerJsFile('@web/mlv/js/get-data.js');
?>
<div style="padding-top: 40px;">
<form id="goodsForm" method="POST" action="<?=Url::to(['order/confirm'])?>">
	<div class="inner">
		<div class="course-info-box clearfix">
			<div class="l">
				<img src="<?=$data['goods_thumb']?>" alt="">
				<div class="clearfix" >
					<div class="r">
						<div class="bdsharebuttonbox" style="width: 275px;">
		                <span class="font-size14 color-808080">分享至：</span>
		                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">&nbsp;</a>
		                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">&nbsp;</a>
		                <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">&nbsp;</a>
		                <a href="#" onclick="return false;" class="popup_douban" data-cmd="douban">&nbsp;</a>
		                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">&nbsp;</a>
           		 	</div>

					</div>
					<span id="goodsLike" onclick="goodsLike(this)"><i class="icon-heart"></i><em>收藏</em></span>
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
    .short{
    	width: 40px;
    	text-align: center;
    }
</style>

			</div>
			<div class="r" style="height: 288px;position: relative;">
				<input type="hidden" name="goods[0][goods_id]" value="<?=$data['goods_id']?>">
				<h2><?=$data['goods_name']?></h2>
				<p style="margin-bottom:20px"><?=$data['subtitle']?></p>

				<?php 
					switch ($data['type']) {
						case 1:
				?>
					<div>
						课时 <?=$data['course']['count_knows_num']?> 课&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学员数 <?=$data['course']['learnnumber']?> 人
					</div>
					<div>
						标签：<?=$data['keywords']?>
					</div>
					<div>
						适用对象：<?=$data['course']['object']?>
					</div>
				<?php
							break;
						case 6:
				?>
					<div>
						学习方式：<?=$data['certification']['studyway']?>
					</div>
					<div>
						考试形式：<?=$data['certification']['examtype']?>
					</div>
					<div>
						适用对象：<?=$data['certification']['object']?>
					</div>
				<?php
							break;
						default:
							break;
					}
				?>

				<div>
				<?php
				if($data['selltype']==0){
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
				}}else{
				?>
					价格：
					<span style="font-size:22px">提交订单咨询价格</span>
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
								echo "购买时长：";
								break;
							case 'module':
								echo "模块：";
								break;
							case 'people':
								echo "直播人数：";
								break;
							case 'definition':
								echo "清晰度：";
								break;
							case 'other':
								echo "其它：";
								break;
							default:
								break;
						}
						foreach ($value as $k => $vo) {
							switch ($vo['inputtype']) {
								case 'radio':
						?>
									<label>
										<input class="attr" type="radio" name="goods[0][attr][]" value="<?=$vo['uniquekey']?>" price="<?=$vo['money']?>" <?php if($k==0){echo "checked";}?>>
										<?=$vo['name']?>
										<input type="hidden" name="goods[0][<?=$vo['uniquekey']?>]" value="1">
									</label>
						<?php
									break;
								case 'checkbox':
						?>
									<label>
										<input class="attr" type="checkbox" name="goods[0][attr][]" value="<?=$vo['uniquekey']?>" price="<?=$vo['money']?>" <?php if($k==0){echo "checked";}?>>
										<?=$vo['name']?>
										<input type="hidden" name="goods[0][<?=$vo['uniquekey']?>]" value="1">
									</label>
						<?php
									break;
								case 'text':
						?>
									<label>
										<input type="text" class="short" name="goods[0][<?=$vo['uniquekey']?>]" value="1">
										<input class="attr" type="hidden" name="goods[0][attr][]" value="<?=$vo['uniquekey']?>" price="<?=$vo['money']?>" <?php if($k==0){echo "checked";}?>>
										<?=$vo['name']?>
									</label>
						<?php
									break;
								default:
									break;
							}
						}
						?>
						
					</div>
				<?php }} ?>
				<?php if($data['type']!=1){ ?>
				<div class="num-box">
					购买数量：
					<div>
						<i onclick="dec()">－</i><input id="goods_num" name="goods[0][num]" value="<?=$data['minbuynumber']?>" type="text" readonly><i onclick="inc()">＋</i>
						<?php if ($data['minbuynumber']>1){ ?><span>&nbsp;最少购买<?=$data['minbuynumber']?>件</span><?php } ?>										
					</div>
				</div>
				<?php }else{ ?>
					<input type="hidden" name="goods[0][num]" value="<?=$data['minbuynumber']?>">
				<?php } ?>
				<div style="bottom: 0;position: absolute;">
				<?php if($data['type']==1 && Helper::hasCourse($data['association_id'])){ ?>
					<a class="bt-style1" href="#func" style="background-color: #fff;margin-right: 20px;">开始学习</a>
				<?php }else{ ?>
					<button class="bt-style1" type="submit" ><?php if ($data['selltype']==0){ echo '立即购买';}else{echo '提交订单';}?></button>
					<?php if($data['selltype']==0){ ?><button id="addCart" class="bt-style1" type="button" >加入购物车</button><?php } ?>
				<?php } ?>
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
			<script id="goods_tuijian" type="text/x-jsrender">
				<dl>
					<dt><a href="{{:href}}"><img src="{{:thumb}}" alt="{{:name}}"></a></dt>
					<dd><a href="{{:href}}">{{:name}}</a></dd>
				</dl>
			</script>
<!--			<dl>-->
<!--				<dt><a href="#"><img src="--><?//=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?><!--" alt=""></a></dt>-->
<!--				<dd><a href="#">NOVA 10 云非编</a></dd>-->
<!--			</dl>-->
<!--			<dl>-->
<!--				<dt><a href="#"><img src="--><?//=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?><!--" alt=""></a></dt>-->
<!--				<dd><a href="#">NOVA 10 云非编</a></dd>-->
<!--			</dl>-->
<!--			<dl>-->
<!--				<dt><a href="#"><img src="--><?//=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?><!--" alt=""></a></dt>-->
<!--				<dd><a href="#">NOVA 10 云非编</a></dd>-->
<!--			</dl>-->
<!--			<dl>-->
<!--				<dt><a href="#"><img src="--><?//=Url::to('@web/mlv/img/temp/asd8972143912.png', true)?><!--" alt=""></a></dt>-->
<!--				<dd><a href="#">NOVA 10 云非编</a></dd>-->
<!--			</dl>-->

		</div>
	</div>
</div>
<div style="margin-top: 20px;margin-bottom: 50px;">
	<div class="inner">
	<?php
		$viewTemplate = 'default';
		if($data['type'] == 1)
		{
			$viewTemplate = 'course';
		}
		echo $this->render('view-'.$viewTemplate, ['data' => $data]);
	?>
		
	</div>

</div>
<script type="text/javascript">
function inc(){
	$('#goods_num').val(parseInt($('#goods_num').val())+1)
}
function dec(){
	var goodsnum = parseInt($('#goods_num').val());
	var newnum = goodsnum-1;
	<?php if($data['minbuynumber']>1){ ?>
		if(newnum < <?=$data['minbuynumber']?>){
			newnum = <?=$data['minbuynumber']?>;
		}
	<?php }else{ ?>
		if(newnum < 1){
			newnum = 1;
		}
	<?php } ?>
	$('#goods_num').val(newnum);
}
$(function(){
	var getDataObj = new getData();
	getDataObj.getGoodsList("all",4,1,function(result){
		var _datas = result.data, _data = _datas.data, htmlOutput="";
		if (_data.length != 0) {
			var u_data = $.map(_data,function(n){
				return {
					thumb:n.goods_thumb,
					href: '<?= Url::to(['/site/goods', 'id'=>''])?>'+n.goods_id,
					name:n.goods_name.substring(0, 15),
				};
			});
			var template = $.templates("#goods_tuijian");
			htmlOutput = template.render(u_data);
		}
		$("#goods_tuijian").after(htmlOutput);
	},["GoodsType=<?= $data['type']?>"]);
});
	function goodsLike(event, type)
	{
		var _collectUrl = '';
		if (type == 'load')
		{
			_collectUrl = "<?= Url::to(['/api/collect/view'])?>";
		} else {
			_collectUrl = "<?= Url::to(['/api/collect/create'])?>";
		}
		$.get(_collectUrl, {goods_id: <?= $data['goods_id']?>}, function(result){
//			console.log(result);
			if (result.code == '0000'){
				$(event).find("i").addClass("icon-heart").removeClass("icon-heart-empty");
				if (type != 'load')
				{
					setTimeout(function(){
						$(".sobey-alert").fadeOut(3000);
					}, 1000);
					sobeyAlert("收藏添加成功");
				}
			} else {
				$(event).find("i").addClass("icon-heart-empty").removeClass("icon-heart");
			}
		})
	}
	goodsLike($("#goodsLike"), 'load');
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
	            	sobeyAlert("加入购物车成功",function(){return;});
	            }else{
	            	sobeyAlert(result.msg,function(){return;});
	            }
	        }
    	});
	});
</script>