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
<style type="text/css">
	.list-style tbody tr td {
		height: 30px;
		text-align: center;
		padding-bottom: 0;
		padding-top: 0;
	}
	.MyCodeIndex{
		float:right;
	}
</style>
<script id="messageList" type="text/x-jsrender">
<table width="100%"  class="list-style">
					<thead>
					<tr>
						<td>激活码</td><td>激活时间</td><!--<td>操作</td>-->
					</tr>
					</thead>
					<tbody>
	{{for messageList}}
					  <tr >
	  <td>{{:activ_code}}</td><td>{{:created_at}}</td>
	  <!--<td><a href="/user/message/view?id={{:id}}">浏览</a></td>-->
	  </tr>
	{{/for}}
	</tbody>
				</table>


  </script>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs">
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">我的激活码</div>
				<div class="MyCodeIndex">激活码</div>
			</ul>
			<div class="am-tabs-bd">
				<div class="am-tab-panel am-fade am-in am-active" id="Mymessage">

				</div>

			</div>
			<div class="text-center" style="padding: 30px 0" id="page"></div>
		</div>
	</div>
</div>

<script>
	var rendDataObj = new renderData();
	var getDataObj = new getData();

	function doData1(pagesize,current,target,pageObj){
		getDataObj.getActivationList(pagesize,current,function(result){
			var u_data = $.map(result.data.data,function(n){
				if (n.id == null) {
					return {};
				}
				n.created_at=formatDate(n.created_at);
				return n;
			});
			var _data = {
				messageList : u_data
			};
			var template = $.templates("#messageList");
			var htmlOutput = template.render(_data);
			target.html(htmlOutput);
			if(pageObj){
				var _pageObj = $.extend(pageObj,{
					currentPage:result.data.currentPage,
					pageSize:result.data.pageSize,
					total:result.data.total,
					dataTarget : target
				});
				rendDataObj.renderPageModel(_pageObj);
			}

		});
	}

	$(function(){
		doData1(10,1,$("#Mymessage"),{
			page_target : "#page",
			page_btFn : "doData1"
		});
		$(".MyCodeIndex").on("mouseover",function(){
			$(this).css({
				"cursor":"pointer"
			})
		}).on("click",function(){
			window.location.href="<?=Url::to(['//user/activation/index'])?>";
		});
	});

</script>