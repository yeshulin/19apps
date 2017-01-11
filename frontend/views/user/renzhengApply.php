<?php
use yii\helpers\Json;
use yii\helpers\Url;

?>
<?php
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/Area.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/AreaData_min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/member-common.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerCssFile('@web/mlv/css/member.css');
//       $this->registerJsFile('@web/mlv/js/Area.js',['position'=>\yii\web\View::POS_HEAD]);
//          $this->registerJsFile('@web/mlv/js/AreaData_min.js',['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/linkage/js/linkagesel-min.js');
$this->registerJsFile('@web/mlv/js/data/e2510ac306aa2a9e0432f7c2dab01783.js');
$this->registerJsFile('@web/mlv/js/cropper-master/assets/js/bootstrap.min.js');
$this->registerJsFile('@web/mlv/js/cropper-master/dist/cropper.js');
$this->registerJsFile('@web/mlv/js/cropper-master/demo/js/main4x3.js');
$this->registerJsFile('@web/mlv/js/canvasToImg.js');


$this->registerCssFile('@web/mlv/js/cropper-master/dist/cropper.css');
$this->registerCssFile('@web/mlv/js/cropper-master/demo/css/main.css');
?>
<style>
    .renzheng-div {
        /*border: 1px solid black;*/
    }

    .renzheng-inner {
        /*padding-top: 5px;
        padding-left: 50px;*/
    }
.form-list {
    margin-top: 0px;
}
    .controls a {
        color: #FFFFFF;
    }

    .upload-button {
        display: inline-block;
        width: 120px;
        height: 35px;
        background-color: #F39800;
        text-align: center;
        font-size: 18px;
        line-height: 35px;
    }
    .text-info{
        margin-bottom: 50px;;
    }
    .bs-callout-warning {
    border-left-color: #aa6708;
}
.bs-callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}
.bs-callout {
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}

    /*.form-list{*/
    /*width:500px;*/
    /*border:1px solid red;*/
    /*text-align:center;*/
    /*margin-top:100px;*/
    /*}*/
    /*.control-group{*/
    /*margin:15px 0;*/
    /*}*/
</style>
<div class="renzheng-div">
    <div class="renzheng-inner">

        <script id="form-list-person" type="text/x-jsrender">
        <div class="text-info" id="u2873" style="visibility: visible;">            
			<div class="alert alert-info text-center" role="alert">
			  <a href="javascript:void(0);" class="alert-link f18 fw-n">您好，欢迎你使用华栖云学院个人认证系统。</a>
			</div>
			
			<div class="bs-callout bs-callout-warning" id="callout-alerts-dismiss-use-button">
			<p><span>认证须知：</span></p>

            <p><span>在您认证之前，请认真阅读以下内容，当您提交认证资格时，表示您已同意华栖云学院个人证的相关规定。</span></p>

            <p><span>一、认证注意事项</span></p>

            <p><span>1、个人认证时请填写真实有效的个人信息。</span></p>

            <p><span>2、个人认证需填写以下资料：</span></p>

            <p><span>姓名：认证人的真实姓名（与身份证上的姓名一致）</span></p>

            <p><code>中文拼音：姓名的中文全拼，首字母大写，姓名当中每个字的拼音之间须加空格。例如：张小三：Zhang Xiao San</code></p>

            <p><span>身份证号：个人的公民身份证号（限制18位）</span></p>

            <p><span>联系电话：本人有效联系电话，以便后期通知认证结果</span></p>

            <p><span>上传寸照：请参照认证页面具体提示</span></p>

            <p><span>二、认证须知</span></p>

            <p><span>1、认证审核：</span><code>我们的工作人员会在三个工作日内审核完毕</code></p>

            <p><span>2、认证信息一经审核将不得更改</span></p>

            <p><code>*请先完成登录再进行认证资料的填写</code></p>
			</div>
            
        </div>
            <div class="clearfix">
             <div style="width: 600px;float: left;">
                	<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">联系人姓名：</div>
						  <div class="col-md-8">
						  	<input name="phoneman" type="text" value="{{:phoneman}}" class="text input-style1" maxlength="20">						  		
						  </div>
					</div>                    
					<!--<div class="row f18 color-style2 form-style1">
						  <div class="col-md-3 text-right">电话号码：</div>
						  <div class="col-md-9">
						  	<input name="mobile" type="text" value="{{:mobile}}" class="text" maxlength="20">						  		
						  </div>
					</div>-->
					<!--<div class="row f18 color-style2 form-style1">
						  <div class="col-md-3 text-right">手机验证码：</div>
						  <div class="col-md-9">
						  	<input name="code" type="text" value="" class="text" maxlength="20">					  		
						  </div>
					</div>     -->
                	<!--<div class="row f18 color-style2 form-style1">
						  <div class="col-md-3 text-right">邮箱：</div>
						  <div class="col-md-9">
						  	<input name="email" type="text" value="{{:email}}" class="text" maxlength="20">			  		
						  </div>
					</div>-->
					<div class="row f18 color-style2 form-style1">

						  <div class="col-md-4 text-right">上传个人寸照：</div>

						  <div class="col-md-8">
						  	<input name="organbook_img" type="hidden" value="{{:organbook_img}}" class="text" maxlength="20">
						  	<img src="{{:organbook_img}}" id="organbook_img" width="120px" height="90px" />						  	
						  	<a href="javascript:void(0);" class="upload-book" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 1000, height: 600}">上传</a>	  		
						  </div>
					</div>  
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">示例：</div>
						  <div class="col-md-8 f12">
						  	<img src="<?=Url::to('@web/mlv/img/temp/cz-sl.jpg', true)?>" width="120" height="90">	
						  		<p>1. 大头照和半身照不可作为寸照使用。</p>
             <p>2. 照片不能进行软件处理，包括裁剪’涂改。 </p>
             <p>3. 照片支持jpg、jpeg、bmp格式，最大不超过5M。 </p> 		
						  </div>
					</div> 
					
                             
                </div>
                <div style="width: 600px;float: right;">
                	 <div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">身份证号：</div>
						  <div class="col-md-8">
						  	<input name="card_num" type="text" value="{{:card_num}}" class="text" maxlength="20">		  		
						  </div>
					</div>  
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">上传身份证：</div>
						  <div class="col-md-8">
						  	<input name="card_img" type="hidden" value="{{:card_img}}" class="text" maxlength="20">
						  	<img src="{{:card_img}}" id="card_img" width="120px" height="90px"/>	
						  	<a href="javascript:void(0);" class="upload-idcard" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 1000, height: 600}">上传</a>	  		
						  </div>
					</div>  
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">示例：</div>
						  <div class="col-md-8 f12">
						  	<img src="<?=Url::to('@web/mlv/img/temp/sfz-sl.jpg', true)?>" width="120" height="90">	
						  		<p>1. 请手持相关证件，临时身份证有效期15天以上。</p>
             <p>2. 照片需免冠，建议未化妆，需身份证本人手持证件。</p>
             <p>3. 必须看清证件号且证件号不能被遮挡。 </p>
             <p>4. 照片支持jpg、jpeg、bmp格式，最大不超过5M。</p>   		
						  </div>
					</div> 
               </div>                                                                                                                                                      
            </div>
			<div class="clearfix" style="padding-top: 30px;padding-bottom: 50px;">				 
                <span id="edit_update" class="bt-style3 pointer center-block">提交</span>				
			</div>
<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">身份证
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                <div class="update-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- <h3 class="page-header">Demo:</h3> -->
                                <div class="img-container">
                                    <img id="image" src="<?= Url::to('@web/mlv/img/member/nophoto.gif', true) ?>"
                                         alt="Picture">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- <h3 class="page-header">Preview:</h3> -->
                                <div class="docs-preview clearfix">
                                    <div class="img-preview preview-lg"></div>
                                </div>
                                <div class="">

                                    <label class="btn btn-primary btn-upload" for="inputImage"
                                           title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                        选择图片
                                    </label>
                                    <button class="btn btn-success" id="upload_IMG_1"><i class="am-icon-check"></i>
                                    </button>
                                     <button class="btn btn-success" id="upload_IMG_2"><i class="am-icon-check"></i>
                                    </button>
                                </div>


                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>
    
        </script>
        
        <script id="form-list-organ" type="text/x-jsrender">
        	<div class="text-info" id="u2873" style="visibility: visible;">            
			<div class="alert alert-info text-center" role="alert">
			  <a href="javascript:void(0);" class="alert-link f18 fw-n">您好，欢迎你使用华栖云学院企业认证系统。</a>
			</div>
			
			<div class="bs-callout bs-callout-warning" id="callout-alerts-dismiss-use-button">
			<p><span>认证须知：</span></p>

            <p><span>在您认证之前，请认真阅读以下内容，当您提交认证资格时，表示您已同意华栖云学院企业证的相关规定。</span></p>

            <p><span>一、认证注意事项</span></p>

            <p><span>1、企业认证时请填写真实有效的企业信息。</span></p>

            <p><span>2、企业认证需填写以下资料：</span></p>

            <p><span>姓名：认证人的真实姓名（与身份证上的姓名一致）</span></p>

            <p><code>中文拼音：姓名的中文全拼，首字母大写，姓名当中每个字的拼音之间须加空格。例如：张小三：Zhang Xiao San</code></p>

            <p><span>身份证号：个人的公民身份证号（限制18位）</span></p>

            <p><span>联系电话：本人有效联系电话，以便后期通知认证结果</span></p>

            <p><span></span></p>

            <p><span>二、认证须知</span></p>

            <p><span>1、认证审核：</span><code>我们的工作人员会在1个工作日内审核完毕</code></p>

            <p><span>2、认证信息一经审核将不得更改</span></p>

            <p><code>*请先完成登录再进行认证资料的填写</code></p>
			</div>
            
        </div>
        <div class="clearfix">
             <div style="width: 600px;float: left;">
                	<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">联系人姓名：</div>
						  <div class="col-md-8">
						  	<input name="phoneman" type="text" value="{{:phoneman}}" class="text input-style1" maxlength="20">						  		
						  </div>
					</div>                    
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">手机号码：</div>
						  <div class="col-md-8">
						  	<input name="mobile" type="text" value="{{:mobile}}" class="text" maxlength="20">						  		
						  </div>
					</div>					
                	
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">企业名称：</div>
						  <div class="col-md-8">
						 	 <input name="name" type="text" value="{{:name}}" class="text" maxlength="20">		  		
						  </div>
					</div>
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">上传企业资质证书：</div>
						  <div class="col-md-8">
						  	<input name="organbook_img" type="hidden" value="{{:organbook_img}}" class="text" maxlength="20">
						  	<img src="{{:organbook_img}}" id="organbook_img" width="120px" height="90px" />						  	
						  	<a href="javascript:void(0);" class="upload-book" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 1000, height: 600}">上传</a>	  		
						  </div>
					</div>  
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">示例：</div>
						  <div class="col-md-8 f12">
						  	<img src="<?=Url::to('@web/mlv/img/temp/qy-sl.jpg', true)?>" width="120" height="90">
						  		<p>1. 必须看清证件号且证件号不能被遮挡。</p>
             <p>2. 照片不能进行软件处理，包括裁剪’涂改。 </p>
             <p>3. 照片支持jpg、jpeg、bmp格式，最大不超过5M。 </p>	
						  </div>
					</div> 
					
                             
                </div>
                <div style="width: 600px;float: right;">
                	<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">邮箱：</div>
						  <div class="col-md-8">
						  	<input name="email" type="text" value="{{:email}}" class="text" maxlength="20">			  		
						  </div>
					</div>
<!--                	 <div class="row f18 color-style2 form-style1">-->
<!--						  <div class="col-md-4 text-right">身份证号：</div>-->
<!--						  <div class="col-md-8">-->
<!--						  	<input name="card_num" type="text" value="{{:card_num}}" class="text" maxlength="20">		  		-->
<!--						  </div>-->
<!--					</div>  -->
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">上传身份证：</div>
						  <div class="col-md-8">
						  	<input name="card_img" type="hidden" value="{{:card_img}}" class="text" maxlength="20">
						  	<img src="{{:card_img}}" id="card_img" width="120px" height="90px"/>	
						  	<a href="javascript:void(0);" class="upload-idcard" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 1000, height: 600}">上传</a>	  		
						  </div>
					</div>  
					<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">示例：</div>
						  <div class="col-md-8 f12">
						  	<img src="<?=Url::to('@web/mlv/img/temp/sfz-sl.jpg', true)?>" width="120" height="90">	
						  		<p>1. 请手持相关证件，临时身份证有效期15天以上。</p>
             <p>2. 照片需免冠，建议未化妆，需身份证本人手持证件。</p>
             <p>3. 必须看清证件号且证件号不能被遮挡。 </p>
             <p>4. 照片支持jpg、jpeg、bmp格式，最大不超过5M。</p>   		
						  </div>
					</div> 
               </div>                                                                                                                                                      
            </div>
            
            <!--laode-->         	           
         
          <div class="clearfix" style="padding-top: 30px;padding-bottom: 50px;">				 
                <span id="edit_update" class="bt-style3 pointer center-block">提交</span>				
		</div>
    </div>

    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">上传图片
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                <div class="update-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <!-- <h3 class="page-header">Demo:</h3> -->
                                <div class="img-container">
                                    <img id="image" src="<?= Url::to('@web/mlv/img/member/nophoto.gif', true) ?>"
                                         alt="Picture">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <!-- <h3 class="page-header">Preview:</h3> -->
                                <div class="docs-preview clearfix">
                                    <div class="img-preview preview-lg" style="width: 120px;height: 90px;border-radius:0px;"></div>
                                </div>
                                <div class="">

                                    <label class="btn btn-primary btn-upload" for="inputImage"
                                           title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                        选择图片
                                    </label>
                                    <button class="btn btn-success" id="upload_IMG_1"><i class="am-icon-check"></i> </button>
                                    <button class="btn btn-success" id="upload_IMG_2"><i class="am-icon-check"></i>
                                    </button>
                                </div>


                            </div>
                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>    
</script>
<div id="form-list-content" class="form-list tab-switch personal-wrap-show">
</div>
</div>
</div>

<script>
    var organInfo =<?=!empty($info)?json_encode($info):"false"?>;
    var userType =<?=$type?>;
    $(function () {
        var data = {
            phoneman: organInfo.phoneman,
            mobile: organInfo.mobile,
            email: organInfo.email,
            card_num: organInfo.card_num,
            card_img: organInfo.card_img,
            organbook_img: organInfo.organbook_img
//            phoneNum:organInfo.mobile,
//            email:organInfo.email,
//		adress1:organInfo.address,
//            adress2:organInfo.address,
//            postcode:organInfo.postcode,
//            authCode:urlPre+"api/member/captcha"

        }
        if (userType == 1) {
            var template = $.templates("#form-list-person");
        } else {
            var template = $.templates("#form-list-organ");
        }
        var htmlOutput = template.render(data);
        $("#form-list-content").html(htmlOutput);
        var member = new memberCommon();
        $("body #edit_update").on("click", function () {
            if (userType == 1) {
                var E_data = {
                    "params": {
                        "phoneman": $(".form-list input[name='phoneman']").val(),
//                      "mobile": $(".form-list input[name='mobile']").val(),
//                      "email": $(".form-list input[name='email']").val(),
                        "card_num": $(".form-list input[name='card_num']").val(),
                        "card_img": $(".form-list input[name='card_img']").val(),
                        "organbook_img": $(".form-list input[name='organbook_img']").val(),
                        "usertype":<?=$type?>
                    }
                };
                //联系人
                if(!member.ckEpt($(".form-list input[name='phoneman']").val())){
                	sobeyAlert("联系人不能为空！");
                	return;
                }
                //身份证号
                if(!member.ckEpt($(".form-list input[name='card_num']").val())){
                	sobeyAlert("身份证号不能为空！");
                	return;
                }else{
                	if(member.ckStr($(".form-list input[name='card_num']").val(),"idcard15") || member.ckStr($(".form-list input[name='card_num']").val(),"idcard18")){
                		
                	}else{
                	sobeyAlert("身份证号填写错误！");
                	return;
                	}
                }
            } else {
                var E_data = {
                    "params": {
                        "phoneman": $(".form-list input[name='phoneman']").val(),
                        "mobile": $(".form-list input[name='mobile']").val(),
                        "email": $(".form-list input[name='email']").val(),
                        "name": $(".form-list input[name='name']").val(),
                        "card_img": $(".form-list input[name='card_img']").val(),
                        "organbook_img": $(".form-list input[name='organbook_img']").val(),
                        "usertype":<?=$type?>
                    }
                };
                
                //联系人
                if(!member.ckEpt($(".form-list input[name='phoneman']").val())){
                	sobeyAlert("联系人不能为空！");
                	return;
                }
                 //手机号
                if(!member.ckEpt($(".form-list input[name='mobile']").val())){
                	sobeyAlert("手机号不能为空！");
                	return;
                }else{
                	if(!member.ckStr($(".form-list input[name='mobile']").val(),"phone")){
                		sobeyAlert("手机号错误！");
                	return;
                	}
                }
                 //邮箱
                if(!member.ckEpt($(".form-list input[name='email']").val())){
                	
                }else{
                	if(!member.ckStr($(".form-list input[name='email']").val(),"email")){
                		sobeyAlert("邮箱格式错误！");
                	return;
                	}
                }
                //企业名称
                if(!member.ckEpt($(".form-list input[name='name']").val())){
                	sobeyAlert("企业名称不能为空！");
                	return;
                }
                
            }
 
            // console.log(E_data);
            member.organAdd(JSON.stringify(E_data), function (result) {
                if (result.msg == "success") {
                    sobeyAlert("申请成功！",function(){
                    	window.location.reload();
                    });
                    
                } else {
                    sobeyAlert("申请失败,请不要重复申请");
                }
            });
        });
        
            $("#upload_IMG_1").on("click", function () {
            	var objThis = $(this);
                var imgObj = $("#image");
                var param = {
                    canvasW: 800,
                    canvasH: 600,
                    canvasX: 0,
                    canvasY: 0,
                    imgW: imgObj.cropper('getData').width,
                    imgH: imgObj.cropper('getData').height,
                    imgX: imgObj.cropper('getData').x,
                    imgY: imgObj.cropper('getData').y,
                    quality: 0.8
                }
                canvasToImg(imgObj[0], param, function (data) {
                    var member = new memberCommon();
                    // console.log(data);
                    member.uploadImg(JSON.stringify({
                        "img": data,
                    }), function (result) {
                        if (result.msg == "success") {
                            $("#card_img")[0].src = result.data;
                            $(".form-list input[name='card_img']").val(result.data);
//                            window.location.reload();
							objThis.parents("#doc-modal-1").find(".am-close").click();							
                        }
                        // console.log(result);
                    });


                });
            });
            $("#upload_IMG_2").on("click", function () {
            	var objThis = $(this);
                var imgObj = $("#image");
                var param = {
                    canvasW: 800,
                    canvasH: 600,
                    canvasX: 0,
                    canvasY: 0,
                    imgW: imgObj.cropper('getData').width,
                    imgH: imgObj.cropper('getData').height,
                    imgX: imgObj.cropper('getData').x,
                    imgY: imgObj.cropper('getData').y,
                    quality: 0.8
                }
                canvasToImg(imgObj[0], param, function (data) {
                    var member = new memberCommon();
                    // console.log(data);
                    member.uploadImg(JSON.stringify({
                        "img": data,
                    }), function (result) {
                        if (result.msg == "success") {
                            $("#organbook_img")[0].src = result.data;
                            $(".form-list input[name='organbook_img']").val(result.data);
                            objThis.parents("#doc-modal-1").find(".am-close").click();
//                            $("#organbook_img").val(result.data);
//                            window.location.reload();
                        }
                        // console.log(result);
                    });


                });
            });
            $("body").on("click",".upload-idcard",function(){
            	// console.log(123);
            	$("#upload_IMG_2").hide();
            	$("#upload_IMG_1").show();
            });
             $("body").on("click",".upload-book",function(){
            	$("#upload_IMG_1").hide();
            	$("#upload_IMG_2").show();
            });
            
    
    });
</script>
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
		width: 120px;
		height: 90px;		
	}
	.update-head .img-preview{
		float: none;
		margin: auto;
	}
	
</style>
