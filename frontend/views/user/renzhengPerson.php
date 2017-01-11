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
        margin-bottom: 50px;
    }

    .renzheng-inner {
        /*padding-top: 5px;*/
        /*padding-left: 50px;*/
    }
    .shenhe{
        margin-left:10px;;
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
</style>
<div class="renzheng-div">
    <div class="renzheng-inner">
        <div class="text" id="u2873" style="visibility: visible;">
   
            <div class="alert alert-info text-center" role="alert">
              <a href="javascript:void(0);" class="alert-link f18 fw-n">我的实名认证信息</a>
            </div>
        </div>
        <script id="form-list-view" type="text/x-jsrender">
            <div class="clearfix">
            <div class="l" style="width: 600px;">

            <div class="row f18 color-style2 form-style1">
                          <div class="col-md-4 text-right">联系人姓名：</div>
                          <div class="col-md-8">
                            <input type="text" value="{{:phoneman}}" disabled="disabled" class="text input-style1" maxlength="20">
                          </div>
                    </div>
                     <div class="row f18 color-style2 form-style1">
                          <div class="col-md-4 text-right">身份证号：：</div>
                          <div class="col-md-8">
                            <input type="text" value="{{:card_num}}" disabled="disabled" class="text input-style1" maxlength="20">
                          </div>
                    </div>
                     <div class="row f18 color-style2 form-style1">
                          <div class="col-md-4 text-right">身份证：</div>
                          <div class="col-md-8">
                             <img src="{{:card_img}}" id="card_img" width="120px" height="90px" />
                          </div>
                    </div>
 <div class="row f18 color-style2 form-style1">
                          <div class="col-md-4 text-right">寸照：</div>
                          <div class="col-md-8">
                             <img src="{{:organbook_img}}" id="organbook_img" width="120px" height="90px" />
                          </div>
                    </div>


                    <div class="row f18 color-style2 form-style1">
                          <div class="col-md-4 text-right"></div>
                          <div class="col-md-4"><span id="edit" class="bt-style3 pointer center-block">编辑</span></div>
                          <div class="col-md-4" style="line-height: 42px;">
                               <span class="shenhe">资料审核中</span>
                          </div>
                    </div>

            </div>
            </div>
 
        </script>
        <script id="form-list-edit" type="text/x-jsrender">
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


        </script>
        <div id="form-list-content" class="form-list tab-switch personal-wrap-show">
        </div>

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
                                    <img id="image" src="<?= \yii\helpers\Url::to('@web/mlv/img/member/nophoto.gif', true) ?>"
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
<script>
    var organInfo =<?=!empty($info)?json_encode($info):"false"?>;
    $(function () {
        var data = {
            phoneman: organInfo.phoneman,
//            mobile: organInfo.mobile,
//            email: organInfo.email,
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
        var template = $.templates("#form-list-view");
        var htmlOutput = template.render(data);
        $("#form-list-content").html(htmlOutput);
        var member = new memberCommon();
        if(organInfo.status==1){//审核通过
            $("body #edit").css({
                "display":"none"
            });
            $("body .shenhe").html("<b style='color:green'>审核通过</b>");
        }
        $("body #edit").on("click", function () {
            var template = $.templates("#form-list-edit");
            var htmlOutput = template.render(data);
            $("#form-list-content").html(htmlOutput);
        });
        $("body").on("click","#edit_update", function () {
            var E_data = {
                "id":organInfo.id,
                "params": {
                    "phoneman": $(".form-list input[name='phoneman']").val(),
//                    "mobile": $(".form-list input[name='mobile']").val(),
//                    "email": $(".form-list input[name='email']").val(),
                    "card_num": $(".form-list input[name='card_num']").val(),
                    "card_img": $(".form-list input[name='card_img']").val(),
                    "organbook_img": $(".form-list input[name='organbook_img']").val(),
                }
            };
            // console.log(E_data);
            member.organEdit(JSON.stringify(E_data), function (result) {
                if (result.msg == "success") {
                    alert("修改成功！");
//                    window.location.reload();
                }else{
                    // console.log(result);
                    alert("修改失败");
                }
            });
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