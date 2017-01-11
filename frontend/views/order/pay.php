<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '支付订单';
?>

<style>
	.confirm-order-table2{
		border: 1px solid #d9d9d9;
		border-bottom: none; 
		width: 450px;
	}
	.confirm-order-table2 tr{
		border-bottom: 1px solid #d9d9d9;
		font-size: 18px;
		color: #333333;
		height: 46px;
	}
	.list-sub-p input{
		padding: 0;
	}
	body{
		background-color: #eee;
	}
</style>

<div class="site-index" style="background: #fff;padding: 50px;margin-bottom: 50px;">
	<div style="width: 452px;margin: auto;">
	<form method="POST" action="">
	<input type="hidden" name="trade_sn" value="<?=$order['trade_sn']?>">
	

	
		<table class="confirm-order-table2">
			<!-- <tr>
				<td class="text-right fw-b">
					商品名称：
				</td>
				<td class="color-style2">
					商品商品
				</td>
			</tr> -->
			<tr>
				<td class="text-right fw-b">
					订单号：
				</td>
				<td class="color-style2">
					<?=$order['trade_sn']?>
				</td>
			</tr>
			<tr>
				<td class="text-right fw-b">订单金额：</td>
				<td class="color-style1"><?=$order['price']?></td>
			</tr>
		</table>
        <p style="text-align: center;font-size: 18px;color:#333333;font-weight: bold;margin-top: 50px;">支付方式：<input type="radio" name="method" value="alipay" checked><img src="<?= Url::to('@web/mlv/img/icon/zfb-logo.jpg', true) ?>" alt=""></p>
         <div style="margin-top: 35px;">
                 <p class="list-sub-p" style="margin-top: 0px;margin: auto;float: none;width: 200px;">
                <input class="bt-style3" type="submit" value="立即付款" name="提交">               
        </p>
        </div>
	</form>
	</div>
</div>
