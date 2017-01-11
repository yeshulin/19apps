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
					<div>

						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">内容：</div>
							<div class="col-md-8">
								<textarea rows="5" name="content"></textarea>
							</div>
						
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">&nbsp;</div>
							<div class="col-md-8">
								<span id="edit_update" class="bt-style3 pointer">保 存</span>
							</div>							
						</div>
					</div>
				</div>
  </script>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to("/user/feedback/index")?>">我的反馈<font>&nbsp;&gt;</font></a>
		<div class="am-tabs">
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">添加反馈</div>
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
			var template = $.templates("#feedbackView");
			var htmlOutput = template.render();
			$("#Myfeedback").html(htmlOutput);
			// renderDataObj.renderCause();
	})
</script>



<script>
	$(function(){
		var member = new memberCommon();
		//确认按钮
		$("body #edit_update").on("click",function(){

			var E_data =  {
				"params": {
					"goods_name":"",
					"content" : $(".form-list textarea[name='content']").val()
				}
			};
			//console.log(E_data);
			member.feedbackadd(JSON.stringify(E_data),function(result){
				//console.log();
				//console.log(result);
				if (result.msg == "success") {
					sobeyAlert('添加成功！',function(){
                    	window.location.href="<?=Url::to(['/user/feedback/index'])?>";
                    });
				}
			});
		});
		

	});

</script>