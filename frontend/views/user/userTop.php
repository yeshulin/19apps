    <?php
    use yii\helpers\url;
    ?>
<?php 
	$this->registerCssFile('@web/mlv/css/member.css');
	$this->registerJsFile('@web/mlv/js/jsrender.min.js',['position'=>\yii\web\View::POS_HEAD]);
	$this->registerJsFile('@web/mlv/js/jsviews.min.js',['position'=>\yii\web\View::POS_HEAD]);
	$this->registerJsFile('@web/mlv/js/get-data.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/mlv/js/render-data.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/mlv/js/user-top.js',['position'=>\yii\web\View::POS_HEAD]);
?>

<div class="user-top">	
	<div class="clearfix">
		<div class="user-top-l1">
			<a class="round-head" style="width: 120px;height: 120px;" href="<?=Url::to("/user/info/edit")?>"><img id="userTop-head" src="<?=Url::to('@web/mlv/img/temp/head.jpg', true)?>" alt=""></a>
			<a href="<?=Url::to("/user/info/edit")?>" class="user-edit">
				<i></i>
			</a>
		</div>
		<div class="user-top-l2">
			<h2>
				<span style="margin-right: 5px;" id="userTop-name"></span>
				<a href="<?=\yii\helpers\Url::to(['//user/info/renzheng?type=1'])?>"><i class="sdcard-icon"></i></a>
				<a href="<?=\yii\helpers\Url::to(['//user/info/renzheng?type=2'])?>"><i class="apv-icon"></i></a>
			</h2>
			<p>
				<a style="margin-right: 40px;" href="<?=Url::to("/user/message/index")?>"><i class="msg-icon"></i>站内信<!--<font><em id="userTop-msg">2</em></font>--></a>
				<!-- <a style="margin-right: 40px;" href="#"><i class="disCou-icon"></i>优惠券<font><em id="userTop-disCou">2</em></font></a> -->
			</p>
		</div>
		<!--<div class="user-top-l3">
			<div>
				<h3><em id="userTop-care">120</em></h3>
				<p>关注</p>
			</div>
			<div style="width: 1px;background-color: #748499;height: 46px;position: relative;"></div>
			<div>
				<h3><em id="userTop-fans">560</em></h3>
				<p>粉丝</p>
			</div>
		</div>-->
	</div>
</div>