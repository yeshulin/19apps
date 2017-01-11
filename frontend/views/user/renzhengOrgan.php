<?php
use yii\helpers\Json;

?>
<?php
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/Area.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/AreaData_min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/member-common.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerCssFile('@web/mlv/css/member.css');
?>
<style>
    .renzheng-div {
        border: 1px solid black;
    }

    .renzheng-inner {
        padding-top: 5px;
        padding-left: 50px;
    }
    .shenhe{
        margin-left:10px;;
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
        <div class="text" id="u2873" style="visibility: visible;">
            <p><span>我的机构认证信息</span></p>
        </div>
        <script id="form-list-view" type="text/x-jsrender">
            <div>
                <div class="control-group clearfix">
                    <label class="control-label">联系人姓名：</label>
                    <span class="controls">
                        <span class="unEdit">{{:phoneman}}</span>
                    </span>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label">电话号码：</label>
                    <span class="controls">
                        <span class="unEdit">{{:mobile}}</span>
                    </span>
                    <div id="" class="error-place">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label">邮箱：</label>
                    <span class="controls">
                        <span class="unEdit">{{:email}}</span>
                    </span>
                    <div id="" class="error-place">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label">企业名称：</label>
                    <span class="controls">
                        <span class="unEdit">{{:name}}</span>
                    </span>
                    <div id="" class="error-place">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label">身份证：</label>
                    <span class="controls">
<!--                        <span class="unEdit">{{:card_img}}</span>-->
                        <img src="{{:card_img}}" id="card_img" width="120px" height="90px" />
                    </span>
                    <div id="" class="error-place">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label">企业资质证书：</label>
                    <span class="controls">
<!--                        <span class="unEdit">{{:organbook_img}}</span>-->
                        <img src="{{:organbook_img}}" id="organbook_img" width="120px" height="90px" />
                    </span>
                    <div id="" class="error-place">
                    </div>
                </div>
                <div class="control-group clearfix priority-low">
                    <label class="control-label">&nbsp;</label>
                    <span style="float:left;">
                        <span id="edit" class="bt-style3 pointer" style="display:inline-block">编辑</span><span class="shenhe">资料审核中</span>
                    </span>
                    <div id="" class="error-place"></div>
                    <div class="error-place mt29"></div>
                </div>
            </div>

        </script>
        <script id="form-list-edit" type="text/x-jsrender">
        <div class="clearfix">
             <div style="width: 560px;float: left;">
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
                <div style="width: 550px;float: right;">
                	<div class="row f18 color-style2 form-style1">
						  <div class="col-md-4 text-right">邮箱：</div>
						  <div class="col-md-8">
						  	<input name="email" type="text" value="{{:email}}" class="text" maxlength="20">
						  </div>
					</div>
<!--                	 <div class="row f18 color-style2 form-style1">-->
<!--						  <div class="col-md-4 text-right">身份证号：</div>-->
<!--						  <div class="col-md-8">-->
<!--						  	<input name="card_num" type="text" value="{{:card_num}}" class="text" maxlength="20">-->
<!--						  </div>-->
<!--					</div>-->
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
                                    <img id="image" src="<?= \yii\helpers\Url::to('@web/mlv/img/member/nophoto.gif', true) ?>"
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
    $(function () {
        var data = {
            phoneman: organInfo.phoneman,
            mobile: organInfo.mobile,
            email: organInfo.email,
            name: organInfo.name,
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
                    "mobile": $(".form-list input[name='mobile']").val(),
                    "email": $(".form-list input[name='email']").val(),
                    "name": $(".form-list input[name='name']").val(),
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
