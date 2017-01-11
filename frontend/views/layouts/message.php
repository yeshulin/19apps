<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '提示信息';
?>
<style>
	.hovere76f45:hover{
		color:#e76f45;		
	}
	.bread-crumbs{
		display:none;
	}
</style>
<div class="site-index">
<?php if($status=='error'){ ?>
	<div style="padding-bottom: 50px;">
    	<div style="text-align: center;padding-top: 130px;"><img src="<?= Url::to('@web/mlv/img/icon/error.png', true) ?>" alt=""></div>
		<p style="font-size: 24px;text-align: center;color: #666;padding-top: 10px;">
		<?=$msg?>
    	<a class="f12 color-style3 hovere76f45" href="<?=$url ?: 'javascript:history.back(-1)'?>">返回</a>
    	</p>
    	
    </div>
<?php }else{ ?>
	<div>
    	<div style="text-align: center;padding-top: 130px;"><img src="<?= Url::to('@web/mlv/img/icon/success.png', true) ?>" alt=""></div>
		<p style="font-size: 24px;text-align: center;color: #666;padding-top: 10px;">
		<?=$msg?>
    	<a class="f12 color-style3 hovere76f45" href="<?=$url ?: 'javascript:history.back(-1)'?>">返回</a>
    	</p>
    	
    </div>
<?php } ?>
    
</div>
