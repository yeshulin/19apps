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
  <script id="feedbackView" type="text/x-jsrender">
<div class="form-list tab-switch personal-wrap-show">
					<div class="row f16" style="padding: 5px 0;">
						<div class="col-md-2 text-right">内容：</div>
						<div class="col-md-10">{{:content}}</div>
					</div>
				</div>
  </script>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to("/user/feedback/index")?>">我的反馈<font>&nbsp;&gt;</font></a>
		<div class="am-tabs">			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">查看反馈</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="Myfeedback">

		    </div>

		  </div>
		</div>
	</div>
</div>
  <script>
	  $(function(){
		  var rendDataObj = new renderData();
		  var getDataObj = new getData();
		  getDataObj.getMyfeedbackView(<?=$id?>,function(result) {
			  //console.log(result.data);
			  var u_data = result.data;
			  //console.log(u_data);

			  var template = $.templates("#feedbackView");
			  var htmlOutput = template.render(u_data);
			  $("#Myfeedback").html(htmlOutput);
			  // renderDataObj.renderCause();
		  })
	  })
  </script>

