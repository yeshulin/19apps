<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '企业实训';
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
?>
<div class="banner2" style="background-image: url(<?=Url::to('@web/mlv/img/temp/banner2.jpg', true)?>);">
	<h1>企业实训平台</h1>
	<h4 style="
    width: 900px;
    margin: 32px auto 0;
    line-height: 35px;
">为你量身定制一个和业务系统完全相同的平台，不占实际业务系统空间，即买即用，让员工轻松掌握工作中所需技能。</h4>
	<div><a class="bt-style2" href="<?=Url::to(['/user/practical/index'])?>">进入我的平台</a></div>
</div>
<script id="course-dl-list" type="text/x-jsrender">
	<div class="textimg-block {{:style}}-block">
<div class="inner clearfix">

	<div class="textimg-block-text">
		<h2>{{:practical_name}}</h2>
		<p>{{:brief}}<!--<a href="{{:href}}" class="color-style1">了解详情&gt;</a>--></p>
		<div><a class="bt-style2" href="{{:href}}">了解详情</a></div>
	</div>
	<div class="textimg-block-img">
		<p>
			<img src="{{:thumb}}" alt="">
		</p>
	</div>
	</div>
</div>
</script>
<div id="practical">

</div>

<!--<div class="textimg-block text-img-block">-->
<!--<div class="inner clearfix">-->
<!---->
<!--	<div class="textimg-block-text">-->
<!--		<h2>NOVA 10 云非编实训平台</h2>-->
<!--		<p>我们的云非编实训平台，让员工能制作出更加方便、快捷、高效的高质量后期特效、音频特技、图文包装、视频画中画，平台的编辑环境和你企业的实际环境完全相同，用了便能对企业的实际生产系统直接上手。<a href="#">了解详情&gt;</a></p>-->
<!--		<div><a class="bt-style2" href="#">开始实训</a></div>-->
<!--	</div>-->
<!--	<div class="textimg-block-img">-->
<!--		<p>-->
<!--			<img src="--><?//=Url::to('@web/mlv/img/temp/564465135.png', true)?><!--" alt="">-->
<!--		</p>		-->
<!--	</div>-->
<!--	</div>-->
<!--</div>-->
<!---->
<!--<div class="textimg-block img-text-block">-->
<!--<div class="inner clearfix">-->
<!---->
<!--	<div class="textimg-block-text">-->
<!--		<h2>NOVA 10 云非编实训平台</h2>-->
<!--		<p>我们的云非编实训平台，让员工能制作出更加方便、快捷、高效的高质量后期特效、音频特技、图文包装、视频画中画，平台的编辑环境和你企业的实际环境完全相同，用了便能对企业的实际生产系统直接上手。<a href="#">了解详情&gt;</a></p>-->
<!--		<div><a class="bt-style2" href="#">开始实训</a></div>-->
<!--	</div>-->
<!--	<div class="textimg-block-img">-->
<!--		<p>-->
<!--			<img src="--><?//=Url::to('@web/mlv/img/temp/564465135.png', true)?><!--" alt="">-->
<!--		</p>		-->
<!--	</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="textimg-block text-img-block">-->
<!--<div class="inner clearfix">-->
<!---->
<!--	<div class="textimg-block-text">-->
<!--		<h2>NOVA 10 云非编实训平台</h2>-->
<!--		<p>我们的云非编实训平台，让员工能制作出更加方便、快捷、高效的高质量后期特效、音频特技、图文包装、视频画中画，平台的编辑环境和你企业的实际环境完全相同，用了便能对企业的实际生产系统直接上手。<a href="#">了解详情&gt;</a></p>-->
<!--		<div><a class="bt-style2" href="#">开始实训</a></div>-->
<!--	</div>-->
<!--	<div class="textimg-block-img">-->
<!--		<p>-->
<!--			<img src="--><?//=Url::to('@web/mlv/img/temp/564465135.png', true)?><!--" alt="">-->
<!--		</p>		-->
<!--	</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="textimg-block img-text-block">-->
<!--<div class="inner clearfix">-->
<!---->
<!--	<div class="textimg-block-text">-->
<!--		<h2>NOVA 10 云非编实训平台</h2>-->
<!--		<p>我们的云非编实训平台，让员工能制作出更加方便、快捷、高效的高质量后期特效、音频特技、图文包装、视频画中画，平台的编辑环境和你企业的实际环境完全相同，用了便能对企业的实际生产系统直接上手。<a href="#">了解详情&gt;</a></p>-->
<!--		<div><a class="bt-style2" href="#">开始实训</a></div>-->
<!--	</div>-->
<!--	<div class="textimg-block-img">-->
<!--		<p>-->
<!--			<img src="--><?//=Url::to('@web/mlv/img/temp/564465135.png', true)?><!--" alt="">-->
<!--		</p>		-->
<!--	</div>-->
<!--	</div>-->
<!--</div>-->
<div class="banner3" style="background-image: url(<?=Url::to('@web/mlv/img/temp/banner3.jpg', true)?>);">
	<h1>定制实训服务</h1>
	<h4>想要个更符合您企业特色的实训平台？就联系我们吧。</h4>
	<div><a class="bt-style2" href="<?=Url::to("/site/site/contact")?>">联系我们</a></div>
</div>

<script type="application/javascript">
$(function(){
		var getDataObj = new getData();

		getDataObj.getGoodsList('practical',20,1,function(result){
			var _data = result.data.data;
			if (_data.length != 0) {
				var i=-1;
				var u_data = $.map(_data,function(n){
					i++;
					return {
						style:(i%2==0 ? 'text-img' : 'img-text'),
						practical_name:n.practical.practical_name,
						thumb: n.practical.thumb,
						href: '<?=Url::to(['/site/goods'])?>?id='+n.goods_id,
						brief: n.practical.brief.replace(/<[^>]+>/g,""),
					};
				});
				var template = $.templates("#course-dl-list");
				var htmlOutput = template.render(u_data);
				$("#practical").append(htmlOutput);
			}
		});
})
</script>
<style>
.banner2 h1 {
    font-size: 54px;
    color: #ffffff;
    text-align: center;
    padding-top: 46px;
}
.banner2 .bt-style2 {
    margin: auto;
    margin-top: 50px;
}

</style>