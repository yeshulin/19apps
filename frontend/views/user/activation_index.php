<?php
    use yii\helpers\url;
    ?>
 <?php
 $this->registerJsFile('@web/mlv/js/amazeui.min.js');
 $this->registerJsFile('@web/mlv/js/jsviews.min.js');
 $this->registerJsFile('@web/mlv/js/Area.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerJsFile('@web/mlv/js/AreaData_min.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerJsFile('@web/mlv/js/member-common.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
  <script id="activationView" type="text/x-jsrender">
		<div class="form-list tab-switch personal-wrap-show">
					<div>

						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">激活码：</div>
							<div class="col-md-8">
								<input name="activ_code">
							</div>
							<div id="" class="error-place">
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">&nbsp;</div>
							<div class="col-md-8">
								<span id="edit_update" class="bt-style3 pointer">保 存</span>
							</div>
							<div id="" class="error-place"></div>
							<div class="error-place mt29"></div>
						</div>
					</div>
				</div>
  </script>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs">			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">激活码</div>
					<div class="MyCode" style="float:right">我的激活码</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="Myactivation">
				
		    </div>
		  </div>
		</div>
	</div>
</div>
  <script>
	  $(function(){
		  var rendDataObj = new renderData();
		  var getDataObj = new getData();
		  var template = $.templates("#activationView");
		  var htmlOutput = template.render();
		  $("#Myactivation").html(htmlOutput);
		  // renderDataObj.renderCause();
	  })
	  var member = new memberCommon();
	  //确认按钮
	  $("body").on("click",'#edit_update',function(){

		  var E_data =  {
			  "act_code": $(".form-list input[name='activ_code']").val(),
		  };
		  //console.log(E_data);
		  member.activation(JSON.stringify(E_data),function(result){
			  if (result.msg == "success") {
			  		sobeyAlert('激活成功！',function(){
                    	window.location.href="<?=Url::to(['/user/activation/list'])?>";
                    });
			  }
		  });
	  });
	  $("body .MyCode").on("mouseover",function(){
		  	$(this).css({
				"cursor":"pointer"
			});
	  }).on("click",function(){
		  window.location.href="<?=Url::to(['//user/activation/list'])?>";
	  });
  </script>