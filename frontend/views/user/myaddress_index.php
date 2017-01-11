<?php
use yii\helpers\url;

?>
<?php
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
//$this->registerJsFile('@web/mlv/js/Area.js', ['position' => \yii\web\View::POS_HEAD]);
//$this->registerJsFile('@web/mlv/js/AreaData_min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/member-common.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerJsFile('@web/mlv/js/data/e2510ac306aa2a9e0432f7c2dab01783.js');
$this->registerJsFile('@web/mlv/js/linkage/js/linkagesel-min.js');
?>
<style type="text/css">
    .list-style tbody tr td {
        height: 30px;
        text-align: center;
        padding-bottom: 0;
        padding-top: 0;
    }
</style>
<script id="addressList" type="text/x-jsrender">
<table width="100%" class="list-style">
				<thead>
					<tr>
						<td>联系人</td><td>联系电话</td><td>联系地址</td><td>操作</td>
					</tr>
					</thead>
	{{for adressList}}
					  <tr >
	  <td>{{:contact}}</td><td>{{:mobile}}</td>
	  <td>{{:linkage}}{{:address}}</td>
	  <td>
          <a href="/user/address/view?id={{:id}}">浏览</a>
          &nbsp;&nbsp;
          <a href="javascript:deladd({{:id}})">删除</a>
          &nbsp;&nbsp;
          <a href="javascript:setDefault({{:id}})">
                {{if status!=3}}
                       设为默认地址
                {{/if}}
          </a>
	  </td>
	  </tr>
	{{/for}}
				</table>
	


</script>
<div class="user-content">
    <div class="user-main-box">
        <a href="<?= Url::to("/user/address/add") ?>">添加收货地址<font>&nbsp;&gt;</font></a>

        <div class="am-tabs">
            <ul class="am-tabs-nav am-nav am-nav-tabs">
                <div class="l">我的收货地址</div>
            </ul>
            <div class="am-tabs-bd">
                <div class="am-tab-panel am-fade am-in am-active" id="Myaddress">

                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var member = new memberCommon();
    $(function () {
        var rendDataObj = new renderData();
        var getDataObj = new getData();
        getDataObj.getMyAddressList(function (result) {
            var u_data = $.map(result.data.data, function (n) {
                if (n.id == null) {
                    return {};
                }
                return n;
            });
            $.each(u_data, function (index, e) {
                if(e.linkage!='' && e.linkage != null && e.linkage != "undefined") {
                    var area = '',_LinkAge=LinkAge1;
                    if (e.linkage != null)
                    {
                        function getLinkAgeName(LinkAge, key)
                        {
                            return LinkAge[key] != undefined ? LinkAge[key] : null;
                        }
                        var linkage = e.linkage.split(',');
                        for (x in linkage) {
                            var _LinkAge = getLinkAgeName(_LinkAge, linkage[x]);
                            if (_LinkAge != null) {
                                area += _LinkAge.name+' ';
                                _LinkAge = _LinkAge.cell;
                            } else {
                                break;
                            }
                        }
                    }
//                    console.log(area);

//                    var _linkage = e.linkage.split(",");

//                    if (_linkage[2] != 0) {
//                        area = getAreaNamebyID(_linkage[2]);
//                    } else if (_linkage[1] != 0) {
//                        area = getAreaNamebyID(_linkage[1]);
//                    } else {
//                        area = getAreaNamebyID(_linkage[0]);
//                    }
                    u_data[index].linkage = area;
                }
            });
//			  u_data.each(function(index,e){
//				 console.log(index);
//			  });
//			  var _linkage = u_data.linkage.split(",");
//			  u_data.linkage=getAreaNamebyID(_linkage[0])+getAreaNamebyID(_linkage[1])+getAreaNamebyID(_linkage[2]);
//            console.log(u_data);
            var _data = {
                adressList: u_data
            };

            if (u_data.length != 0) {
                var template = $.templates("#addressList");
                var htmlOutput = template.render(_data);
                $("#Myaddress").html(htmlOutput);
            }
        });

        // renderDataObj.renderCause();
    })
//    function getAreaNamebyID(areaID) {
//        var areaName = "";
//        if (areaID.length == 2) {
//            areaName = area_array[areaID];
//        } else if (areaID.length == 4) {
//            var index1 = areaID.substring(0, 2);
//            areaName = area_array[index1] + " " + sub_array[index1][areaID];
//        } else if (areaID.length == 6) {
//            var index1 = areaID.substring(0, 2);
//            var index2 = areaID.substring(0, 4);
//            areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
//        }
//        return areaName;
//    }
    function deladd(id) {
        var E_data = {
            "id": id
        };
        member.addressdel(JSON.stringify(E_data), function (result) {
            //console.log();
            //console.log(result);
            if (result.msg == "success") {
               // alert("删除成功！");
                window.location.reload();
            }
        });

    }
    function setDefault(id) {
        var E_data = {
            "id": id
        };
        member.addressdefault(JSON.stringify(E_data), function (result) {
            //console.log();
            //console.log(result);
            if (result.msg == "success") {
                // alert("删除成功！");
                window.location.reload();
            }
        });

    }
</script>