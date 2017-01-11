  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
 <style type="text/css">
 	.list-style tbody tr td {
    height: 30px;
    text-align: center;
    padding-bottom: 0;
    padding-top: 0;
}
 </style>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs" data-am-tabs>			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l"><?=$lab_name?>使用人员列表</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" >
				<table width="100%"  class="list-style">
					<thead>
					<tr>
						<td>使用人员</td><td>激活时间</td><td>状态</td>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach($uselist as $key=>$val){
						?>
						<tr >
							<td><?=$val['username']?></td><td><?=date("Y-m-d H:i:s",$val['created_at'])?></td><td><a href="<?=Url::to(["/user/lab/delgrant",'id'=>$val['id'],'lab_id'=>$val['lab_id'],'lab_name'=>$lab_name])?>">取消权限</a></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>


		    </div>

		  </div>
		</div>
	</div>
</div>
