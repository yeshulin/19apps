<?php
use yii\helpers\url;
?>
<?php
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
//$this->registerJsFile('@web/mlv/js/Area.js',['position'=>\yii\web\View::POS_HEAD]);
//$this->registerJsFile('@web/mlv/js/AreaData_min.js',['position'=>\yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/member-common.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerJsFile('@web/mlv/js/data/e2510ac306aa2a9e0432f7c2dab01783.js');
$this->registerJsFile('@web/mlv/js/linkage/js/linkagesel-min.js');
?>
<script id="addressView" type="text/x-jsrender">
<div class="form-list tab-switch personal-wrap-show">
					<div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">联系人：</div>
							<div class="col-md-8">
								<input name="contact" type="text" value="" class="text" maxlength="20">
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">联系电话：</div>
							<div class="col-md-8">
								<input name="mobile" type="text" value="" class="text" maxlength="20">
							</div>
							<div id="" class="error-place">
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right"><em>*&nbsp;</em>地址：</div>
							<div class="col-md-8">
								<select id="arear"></select>
<!--								<select id="seachprov" name="seachprov" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');"></select>&nbsp;&nbsp;-->
<!--								<select id="seachcity" name="homecity" onChange="changeCity(this.value,'seachdistrict','seachdistrict');"></select>&nbsp;&nbsp;-->
<!--								<span id="seachdistrict_div"><select id="seachdistrict" name="seachdistrict"></select></span>-->

								<!--<input type="button"  value="获取地区" onClick="showAreaID()"/>-->
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">详细地址：</div>
							<input id="" type="hidden" autocomplete="off" value="">
							<div class="col-md-8">
								<input id="" name="address" type="text" class="text" value="" maxlength="20">
							</div>
							<div id="" class="error-place">
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">备注：</div>
							<div class="col-md-8">
								<textarea rows="5" name="remark"></textarea>
							</div>
							<div id="" class="error-place">
							</div>
						</div>
						<div class="row f18 color-style2 form-style1">
							<div class="col-md-4 text-right">&nbsp;</div>
							<div class="col-md-8">
								<span id="edit_update"  class="bt-style3 pointer">保 存</span>
							</div>
							<div id="" class="error-place"></div>
							<div class="error-place mt29"></div>
						</div>
					</div>
				</div>
  </script>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to("/user/address/index")?>">我的收货地址<font>&nbsp;&gt;</font></a>
		<div class="am-tabs">
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">添加收货地址</div>
			</ul>
			<div class="am-tabs-bd">
				<div class="am-tab-panel am-fade am-in am-active" id="Myaddress_content">

				</div>

			</div>
		</div>
	</div>
</div>
<script>
	$(function(){

//			initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '51', '0', '0');
			// renderDataObj.renderCause();
	})
</script>

<script type="text/javascript">
	// $(function (){
	// 	initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '51', '0', '0');
	// });

	//得到地区码
//	function getAreaID(){
//		var area = 0;
//		if($("#seachdistrict").val() != "0"){
//			area = $("#seachdistrict").val();
//		}else if ($("#seachcity").val() != "0"){
//			area = $("#seachcity").val();
//		}else{
//			area = $("#seachprov").val();
//		}
//		return area;
//	}
//
//	function showAreaID() {
//		//地区码
//		var areaID = getAreaID();
//		//地区名
//		var areaName = getAreaNamebyID(areaID) ;
//		alert("您选择的地区码：" + areaID + "      地区名：" + areaName);
//	}
//
//	//根据地区码查询地区名
//	function getAreaNamebyID(areaID){
//		var areaName = "";
//		if(areaID.length == 2){
//			areaName = area_array[areaID];
//		}else if(areaID.length == 4){
//			var index1 = areaID.substring(0, 2);
//			areaName = area_array[index1] + " " + sub_array[index1][areaID];
//		}else if(areaID.length == 6){
//			var index1 = areaID.substring(0, 2);
//			var index2 = areaID.substring(0, 4);
//			areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
//		}
//		return areaName;
//	}
</script>

<script>


	$(function(){
		var rendDataObj = new renderData();

		var template = $.templates("#addressView");
		var htmlOutput = template.render();
		$("#Myaddress_content").html(htmlOutput);
		var linkageSel = new LinkageSel({
			data: LinkAge1,
			select: '#arear',
			head: '--请选择--'
		});
		var member = new memberCommon();
		//确认按钮
		$("body #edit_update").on("click",function(){
			var _contact = $(".form-list input[name='contact']").val();
			var _mobile = $(".form-list input[name='mobile']").val();
			var _address = $(".form-list input[name='address']").val();
			var _remark = $(".form-list textarea[name='remark']").val();

//			var _prov = $("#seachprov").val();
//			var _city = $("#seachcity").val();
//			var _district = $("#seachdistrict").val();

			var _linkage=linkageSel.getSelectedArr().join(",");

			var E_data =  {
				"params": {
					"contact" : _contact,
					"mobile" : _mobile,
					"address" : _address,
					"remark" : _remark,
					"linkage" :_linkage

				}
			};
			
			if(member.ckEpt(_contact)){
				
			}else{
				sobeyAlert("联系人不能为空！",function(){});
				return false;
			}
			
			if(member.ckEpt(_mobile)){
				if(member.ckStr(_mobile,"phone")){
					
				}else{
					sobeyAlert("联系电话格式错误！",function(){});
					return false;
				}
			}else{
				sobeyAlert("联系电话不能为空！",function(){});
				return false;
			}
			if(member.ckEpt(_address)){
				
			}else{
				sobeyAlert("详细地址不能为空！",function(){});
				return false;
			}
			
			member.addressadd(JSON.stringify(E_data),function(result){
				if (result.msg == "success") {
					sobeyAlert("添加成功！",function(){
						window.location.href="<?=Url::to(['//user/address/index'])?>";
					});
				}
			});
		});


	});

</script>