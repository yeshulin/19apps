  <?php
    use yii\helpers\url;
    ?>
 <?php
 $this->registerJsFile('@web/mlv/js/amazeui.min.js');
 $this->registerJsFile('@web/mlv/js/jsviews.min.js');
 $this->registerJsFile('@web/mlv/js/Area.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerJsFile('@web/mlv/js/AreaData_min.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerJsFile('@web/mlv/js/member-common.js');
 $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
<script id="messageView" type="text/x-jsrender">
	<div>
		<div class="row f16" style="padding: 5px 0;">
			<div class="col-md-2 text-right">主题：</div>
			<div class="col-md-8" style="word-break:break-all;">
				{{:subject}}
			</div>
		</div>
		<hr style="margin: 20px 40px" />
		<div class="row f16" style="padding: 5px 0;">
			<div class="col-md-2 text-right">内容：</div>
			<div class="col-md-8" style="word-break:break-all;">
				{{:content}}
			</div>
		</div>
	</div>
</script>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to(["/user/message/index"])?>">返回消息列表<font>&nbsp;&gt;</font></a>		
		<div class="am-tabs">			
			<ul class="am-tabs-nav am-nav am-nav-tabs">					
				<div class="l">我的系统消息</div>
			</ul>					 
		<div class="am-tabs-bd">
			<div class="am-tab-panel am-active" style="padding: 30px 10px" id="Mymessage">
		    	
		    </div>
		  </div>
		</div>
	</div>
</div>
  <script>
	  $(function(){
		  var rendDataObj = new renderData();
		  var getDataObj = new getData();
		  getDataObj.getMymessageView(<?=$id?>,function(result) {
			  var u_data = result.data;
			  var template = $.templates("#messageView");
			  var htmlOutput = template.render(u_data);
			  $("#Mymessage").html(htmlOutput);
			  // renderDataObj.renderCause();
		  })
	  })
  </script>