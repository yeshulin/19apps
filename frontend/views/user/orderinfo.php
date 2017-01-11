  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to(["/user/order/list"])?>">返回订单列表<font>&nbsp;&gt;</font></a>		
		<div class="am-tabs">
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">订单号：<?=$trade_sn?></div>
			</ul>
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-active" style="padding: 30px 10px" id="user-orderview">
		    	
		    </div>
		  </div>
		</div>
	</div>
</div>
<script>
$(function(){
	var rendDataObj = new renderData(); 
	var getDataObj = new getData();
	getDataObj.getOrderview("<?=$trade_sn?>",function(result){
		rendDataObj.renderOrderview($("#user-orderview"),result.data);
	});
});
</script>