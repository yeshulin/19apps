  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');   
     $this->registerJsFile('@web/mlv/js/jsviews.min.js');   
//       $this->registerJsFile('@web/mlv/js/Area.js',['position'=>\yii\web\View::POS_HEAD]);
//          $this->registerJsFile('@web/mlv/js/AreaData_min.js',['position'=>\yii\web\View::POS_HEAD]);
 $this->registerJsFile('@web/mlv/js/linkage/js/linkagesel-min.js');
 $this->registerJsFile('@web/mlv/js/member-common.js');
 $this->registerJsFile('@web/mlv/js/data/e2510ac306aa2a9e0432f7c2dab01783.js');
 $this->registerJsFile('@web/mlv/js/cropper-master/assets/js/bootstrap.min.js');
 $this->registerJsFile('@web/mlv/js/cropper-master/dist/cropper.js');
 $this->registerJsFile('@web/mlv/js/cropper-master/demo/js/main.js');
  $this->registerJsFile('@web/mlv/js/canvasToImg.js');
 




 $this->registerCssFile('@web/mlv/js/cropper-master/dist/cropper.css');
 $this->registerCssFile('@web/mlv/js/cropper-master/demo/css/main.css');
 ?>

<script id="personEdit" type="text/x-jsrender">
	<div class="main-wrap mt15 border-style1" style="position: relative;padding-bottom: 50px;">
						<h3 class="f16 color-style5 fw-n" style="padding: 15px 14px;border-bottom: 1px solid #ddd;margin-left: 10px;margin-right: 10px;;">
	                        	个人信息
	                    </h3>
						<div class="user-profile clearfix">
							<div class="user-profile-wrap">
								<div class="profile-avatar">
									<img src="{{:userHead}}" height="150" width="150">
									<a href="javascript:void(0);" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 1000, height: 600}">编辑头像</a>									
								</div>
							</div>
							
						</div>
						<div class="form-list tab-switch personal-wrap-show">
							<div>
								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">用户名：</div>
									<div class="col-md-8">
						  				{{:userName}}
						  			</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">昵称：</div>
									<input id="" type="hidden" autocomplete="off" value="">
									<div class="col-md-8">
						  				<input name="E_nickName" type="text" value="{{:nickName}}" class="text" maxlength="20">
						  			</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">性别：</div>
									<div class="col-md-8">
						  				{{if sex == "1" }}
										<label class="sex-label">
											<input type="radio" value="1" name="sex" checked="checked">
											<span>男</span>
										</label>
										<label class="sex-label">
											<input type="radio" value="2" name="sex">
											<span>女</span>
										</label>	
										<label class="sex-label">
											<input type="radio" value="0" name="sex">
											<span>保密</span>
										</label>
										{{/if}}
										{{if sex == "2" }}
										<label class="sex-label">
											<input type="radio" value="1" name="sex">
											<span>男</span>
										</label>
										<label class="sex-label">
											<input type="radio" value="2" name="sex" checked="checked">
											<span>女</span>
										</label>	
										<label class="sex-label">
											<input type="radio" value="0" name="sex">
											<span>保密</span>
										</label>	
										{{/if}}
										{{if sex == "0" }}
										<label class="sex-label">
											<input type="radio" value="1" name="sex">
											<span>男</span>
										</label>
										<label class="sex-label">
											<input type="radio" value="2" name="sex">
											<span>女</span>
										</label>	
										<label class="sex-label">
											<input type="radio" value="0" name="sex" checked="checked">
											<span>保密</span>
										</label>
										{{/if}}
						  			</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">手机：</div>
									<div class="col-md-8">
										<span>{{:phoneNum}}</span>
										<a href="javascript:void(0);" id="edt-phone">修改</a>
						  			</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">邮箱：</div>
									<div class="col-md-8">
										<span>{{:email}}</span>
										<a href="javascript:void(0);" id="edt-email">修改</a>
						  			</div>
								</div>
								
							
								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right"><em>*&nbsp;</em>地址：</div>
									<div class="col-md-8">
										<select id="arear"></select>
										<!--<input type="button"  value="获取地区" id="getAera"/>-->
										<!--<select id="seachprov" name="seachprov" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');"></select>&nbsp;&nbsp;
										<select id="seachcity" name="homecity" onChange="changeCity(this.value,'seachdistrict','seachdistrict');"></select>&nbsp;&nbsp;
										<span id="seachdistrict_div"><select id="seachdistrict" name="seachdistrict"></select></span>-->

										<!--<input type="button"  value="获取地区" onClick="showAreaID()"/>-->
									</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">详细地址：</div>
									<input id="" type="hidden" autocomplete="off" value="">
									<div class="col-md-8">
										<input id="" name="E_address2" type="text" class="text" value="{{:adress2}}" maxlength="20">
									</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<div class="col-md-4 text-right">邮编：</div>
									<input id="" type="hidden" autocomplete="off" value="">
									<div class="col-md-8">
										<input id="" type="text" name="E_postCode" class="text" value="{{:postcode}}" maxlength="20">
									</div>
								</div>

								<div class="row f18 color-style2 form-style1">
									<input id="" type="hidden" autocomplete="off">
									<div class="col-md-4 text-right">验证码：</div>
									<div class="col-md-8">
										<input id="" type="text" class="text" maxlength="5" autocomplete="off" name="authCode" style="width:150px" value="">
										<span class="tips-words"></span>
										<img src="{{:authCode}}" id="" width="62" height="24" class="authCode">
										<span class="changeAuthCode" style="margin-bottom: 10px;"><i style="margin-bottom: -4px;position: absolute;cursor: pointer;">换一张</i></span>
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
					</div>
					
					
					
					


<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">修改头像
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
    <div class="update-head">
	 <div class="container">
    <div class="row">
      <div class="col-md-9">
        <!-- <h3 class="page-header">Demo:</h3> -->
        <div class="img-container">
          <img id="image" src="<?=Url::to('@web/mlv/img/member/nophoto.gif', true)?>" alt="Picture">
        </div>
      </div>
      <div class="col-md-3">
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>        
        </div>
				<div class="">
         
          <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
            <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">           
            	选择图片
          </label>
         	<button class="btn btn-success" id="upload_IMG"><i class="am-icon-check"></i></button>
        </div>
       
       
      </div>
    </div>

  </div>

	
</div>
    
    
    </div>
  </div>
</div>
 </script>

<div id="personEdit_content" class="user-content">
	
</div>
<style>

	.update-head{
		    width: 960px;
    float: right;
	}
	.update-head .container{
		width: 960px;
	}
	.update-head .img-container{
		width: 720px;
		
	}
	.update-head .preview-lg{
		width: 225px;
		border-radius: 100%;
	}
	.update-head .img-preview{
		float: none;
		margin: auto;
	}
	.form-style1{
		font-size: 14px;
		margin-bottom: 10px;
	}
	.sex-label{
		font-weight: normal;
	}
</style>



<script>
$(function(){
	var rendDataObj = new renderData(); 
	var getDataObj = new getData();
	var data = {
		userHead:userInfo.headimg,
		userName:userInfo.username,
		nickName:userInfo.nickname,
		sex:userInfo.sex,
		phoneNum:userInfo.mobile,
		email:userInfo.email,
//		adress1:userInfo.address,
		adress2:userInfo.address,
		postcode:userInfo.postcode,
		authCode:urlPre+"api/member/captcha"

	}
	var template = $.templates("#personEdit");
	var htmlOutput = template.render(data);
	$("#personEdit_content").html(htmlOutput);
	var linkageSel = new LinkageSel({
		data: LinkAge1,
		select: '#arear',
		head: '--请选择--',
		defVal: userInfo.linkage != null && userInfo.linkage.split(',')
	});
	$('#getAera').click(function() {
		var arr = linkageSel.getSelectedArr(),
			d = linkageSel.getSelectedDataArr('name');
		alert(d.join('  ')+'----'+arr.join(','));
	});
	var member = new memberCommon();
	//确认按钮
	$("body #edit_update").on("click",function(){

		var E_data =  {
			"id": userInfo.id,
			"Member": {
				"nickname": $(".form-list input[name='E_nickName']").val(),
				"address": $(".form-list input[name='E_address2']").val(),
				"linkage": linkageSel.getSelectedArr().join(','),
				"sex" : parseInt($(".form-list input[name='sex']:checked").val()),
				"postcode" : $(".form-list input[name='E_postCode']").val()
			}
		};
		//console.log(E_data);
		member.imgScode($(".form-list input[name='authCode']").val(),function(result){
			if(result.msg == "success"){
				member.update(JSON.stringify(E_data),function(result){
					if (result.msg == "success") {
						sobeyAlert('修改成功！',function(){
							window.location.reload();
      					});
						//alert("修改成功！");
						//window.location.reload();
					}
				});
			}else{
				sobeyAlert('验证码错误！',function(){});
			}
		});



	});
	

	//更换验证图片
	$("body .changeAuthCode").on("click",function(){
		var _img = $(".authCode");
		_img[0].src = urlPre + "api/member/captcha?" + Math.random();
	});


//	initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '51', '0', '0');
	// renderDataObj.renderCause();
	
	$(function(){
		$("#upload_IMG").on("click",function(){
			var imgObj = $("#image");
			var param = {
				canvasW : 300,
				canvasH : 300,
				canvasX : 0,
				canvasY : 0,
				imgW : imgObj.cropper('getData').width,
				imgH : imgObj.cropper('getData').height,
				imgX : imgObj.cropper('getData').x,
				imgY : imgObj.cropper('getData').y,
				quality : 0.8 
			}
			canvasToImg(imgObj[0],param,function(data){
				var member = new memberCommon();
								// console.log(data);
								 
				member.uploadHead(JSON.stringify({
  "headimg":data,
}),function(result){
					if(result.msg == "success"){
						window.location.reload();
					}
					// console.log(result);
				});

				
			});
		});
	})
})
</script>

<script type="text/javascript">
// $(function (){
// 	initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '51', '0', '0');
// });

//得到地区码
//function getAreaID(){
//	var area = 0;
//	if($("#seachdistrict").val() != "0"){
//		area = $("#seachdistrict").val();
//	}else if ($("#seachcity").val() != "0"){
//		area = $("#seachcity").val();
//	}else{
//		area = $("#seachprov").val();
//	}
//	return area;
//}
//
//function showAreaID() {
//	//地区码
//	var areaID = getAreaID();
//	//地区名
//	var areaName = getAreaNamebyID(areaID) ;
//	alert("您选择的地区码：" + areaID + "      地区名：" + areaName);
//}
//
////根据地区码查询地区名
//function getAreaNamebyID(areaID){
//	var areaName = "";
//	if(areaID.length == 2){
//		areaName = area_array[areaID];
//	}else if(areaID.length == 4){
//		var index1 = areaID.substring(0, 2);
//		areaName = area_array[index1] + " " + sub_array[index1][areaID];
//	}else if(areaID.length == 6){
//		var index1 = areaID.substring(0, 2);
//		var index2 = areaID.substring(0, 4);
//		areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
//	}
//	return areaName;
//}
</script>