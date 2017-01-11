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


<div id="personEdit_content" class="user-content">
	<div class="main-wrap mt15 border-style1" style="position: relative;padding-bottom: 50px;">
						<h3 class="f16 color-style5 fw-n" style="padding: 15px 14px;border-bottom: 1px solid #ddd;margin-left: 10px;margin-right: 10px;;">
	                        	个人信息
	                    </h3>

		<div class="form-list tab-switch personal-wrap-show">
			<div>
				<div class="row f18 color-style2 form-style1">
					<div class="col-md-4 text-right">当前密码：</div>
					<div class="col-md-8">
						<input name="oldPassword" type="password" value="" class="text" maxlength="20">
					</div>
				</div>
				<div class="row f18 color-style2 form-style1">
					<div class="col-md-4 text-right">新密码：</div>
					<div class="col-md-8">
						<input name="newPassword" type="password" value="" class="text" maxlength="20">
					</div>
					<div id="" class="error-place">
					</div>
				</div>
				<div class="row f18 color-style2 form-style1">
					<div class="col-md-4 text-right">确认新密码：</div>
					<div class="col-md-8">
						<input name="renewPassword" type="password" value="" class="text" maxlength="20">
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
	</div>
</div>



<script>
	$(function(){
		var member = new memberCommon();
		//确认按钮
		$("body #edit_update").on("click",function(){
			var newPsw = $(".form-list input[name='newPassword']").val();
			var oldPsw = $(".form-list input[name='oldPassword']").val();
			var newPsw2 = $(".form-list input[name='renewPassword']").val();
			var E_data =  {
				"id": userInfo.id,
				"oldPassword":oldPsw,
				"newPassword":newPsw,
			};
						
			if(member.ckStr(newPsw,"password")){
				
				if(newPsw == newPsw2){
					member.pwd(JSON.stringify(E_data),function(result){
					if (result.msg == "success") {
						sobeyAlert('密码修改成功！',function(){
							window.location.reload();
      					});
					}else{
						sobeyAlert(result.error,function(){});
					}
				});
				}else{
					sobeyAlert("两次密码输入不一致！",function(){});
				}
				
			}else{
				sobeyAlert("两次密码输入不一致！",function(){});
			}
		});

	});

</script>