<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '直播课程';
?>
<style>
	.inner dl:hover{     opacity: .8; }
</style>
<div class="banner4 text-center" style="background: url(<?=Url::to('@web/mlv/img/temp/banner4.jpg', true)?>) no-repeat top center;height: 550px;">
	<h1 class="f48 color-style0" style="padding-top: 90px;">教育直播平台服务</h1>
	<p class="f18 color-style4" style="width: 886px;margin: 35px auto 0;">依托遍布全国的阿里云计算中心和超过500个节点的阿里云CDN，充分发挥华栖云的媒体技术服务优势，为教育行业度身定制了面向多终端的直播平台服务。</p>
	<a class="bt-style3" href="<?=Url::to(['/user/live/index'])?>" style="margin: 70px auto 0;">进入我的直播</a>
</div>

<div class="backimg-text" style="background-image: url(<?=Url::to('@web/mlv/img/temp/zbxq1.jpg', true)?>);">
	<div class="inner clearfix">
		<div class="l">
			<h2>直播教室</h2>
			<p>每一间教室，每一堂课程，都应该有自己专属的直播。</p>
			<a href="<?= Url::to(['view', 'type'=>'class'])?>" class="bt-style1">了解详情</a>
		</div>
	</div>
</div>
<div class="backimg-text" style="background-image: url(<?=Url::to('@web/mlv/img/temp/zbxq2.jpg', true)?>);">
	<div class="inner clearfix">
		<div class="r">
			<h2>直播校园</h2>
			<p>用学校自己的门户, 直播学校自己的高价值内容。</p>
			<a href="<?= Url::to(['view', 'type'=>'school'])?>" class="bt-style1">了解详情</a>
		</div>
	</div>
</div>
<div class="backimg-text" style="background-image: url(<?=Url::to('@web/mlv/img/temp/zbxq3.jpg', true)?>);">
	<div class="inner clearfix">
		<div class="l">
			<h2>区域直播平台</h2>
			<p>统一的直播运营平台，最大化的提升直播内容价值。</p>
			<a href="<?= Url::to(['view', 'type'=>'platform'])?>" class="bt-style1">了解详情</a>
		</div>
	</div>
</div>
<div  style="background-color: #d6e5f5;height: 500px;">
	<div class="inner">
		<h2 style="padding-top: 50px;font-size: 42px;color: #465566;" class="text-center">直播扩展包</h2>
		<div class="clearfix" style="margin-top: 65px;">
			<a href="<?=Url::to(['/site/goods','id'=>344])?>">
				<dl class="l text-center" style="width: 400px;">
					<dt><img src="<?=Url::to('@web/mlv/img/temp/zbxq-icon1.png', true)?>" alt=""></dt>
					<dd style="margin-top: 20px;">
						<h4 class="f18" style="color:#455c73;">• 增加直播服务包</h4>
						<p class="f14" style="color:#667f9a;margin-top: 12px;">让您的直播能够送达更多的观众、持续更长的时间</p>
					</dd>
				</dl>
			</a>
			<a href="<?=Url::to(['/site/goods','id'=>326])?>">
				<dl class="l text-center" style="width: 400px;">
					<dt><img src="<?=Url::to('@web/mlv/img/temp/zbxq-icon2.png', true)?>" alt=""></dt>
					<dd style="margin-top: 20px;">
						<h4 class="f18" style="color:#455c73;">• 增加直播通道</h4>
						<p class="f14" style="color:#667f9a;margin-top: 12px;">让更多优质内容能够同时推出，无需排队等待</p>
					</dd>
				</dl>
			</a>
			<a href="<?=Url::to(['/site/goods','id'=>350])?>">
				<dl class="l text-center" style="width: 400px;">
					<dt><img src="<?=Url::to('@web/mlv/img/temp/zbxq-icon3.png', true)?>" alt=""></dt>
					<dd style="margin-top: 20px;">
						<h4 class="f18" style="color:#455c73;">• 增加直播切换台</h4>
						<p class="f14" style="color:#667f9a;margin-top: 12px;">选择最优秀的内容，在最合适的通道上直播</p>
					</dd>
				</dl>
			</a>
		</div>
		
	</div>

</div>
<div style="background: url(<?=Url::to('@web/mlv/img/temp/zbxq4.jpg', true)?>) no-repeat top center; height: 685px;" >
	<div class="inner">
		<h3 class="text-center fw-n" style="font-size: 42px;padding-top: 60px;">直播工具</h3>
		<p class="f18 text-center color-style3" style="margin-top: 15px;">用户可以通过多种工具和设备，提供直播信号，并实现相应的功能业务</p>
		<div class="clearfix" style="margin-top: 80px;">
			<div class="r" style="width: 366px;">
				<div style="margin-bottom: 35px;">
					<h3 class="f18 color-style2 fw-n">• PGC手机直播工具</h3>
					<p class="f14 color-style3">利用手机App，实现在任意地点，任意时间的流媒体直播应用。<!--<a class="color-style1" href="#">了解详情</a>--></p>
					<div style="margin-top: 25px;width: 300px;height: 1px;border-bottom: 1px dashed #eeeeee;"></div>
				</div>
				<div style="margin-bottom: 35px;">
					<h3 class="f18 color-style2 fw-n">• E-VK 微课直播工具</h3>
					<p class="f14 color-style3">在笔记本、工作站等平台安装，将电脑屏幕+摄像头数据进行整合直播。<!--<a class="color-style1" href="#">了解详情</a>--></p>
					<div style="margin-top: 25px;width: 300px;height: 1px;border-bottom: 1px dashed #eeeeee;"></div>
				</div>
				<div style="margin-bottom: 35px;">
					<h3 class="f18 color-style2 fw-n">• E-Studio 教育直播切换台</h3>
					<p class="f14 color-style3">利用专业工具设备，实现多机位、多信号源、多种特效和3D物件的直播应用。<!--<a class="color-style1" href="#">了解详情</a>--></p>
				</div>

			</div>
			
		</div>
	</div>
</div>
<div class="banner5 text-center" style="background: url(<?=Url::to('@web/mlv/img/temp/banner5.jpg', true)?>) no-repeat top center;height: 500px;">
	<h1 class="color-style0 fw-n" style="padding-top: 120px;font-size: 42px;">定制直播服务</h1>
	<p class="f18 color-style0" style="width: 886px;margin: 25px auto 0;">我们有最优秀的直播业务专家，期待为您提供专属于您的直播服务</p>
	<a class="bt-style3" href="<?=Url::to("/site/site/contact")?>" style="margin: 90px auto 0;">联系我们</a>
</div>