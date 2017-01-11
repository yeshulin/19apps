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
  <script id="liveView" type="text/x-jsrender">
<div class="form-list tab-switch personal-wrap-show">
					<div class="row f16" style="padding: 5px 0;">
						<div class="col-md-2 text-right">直播名称：</div>
						<div class="col-md-10">{{:live_name}}</div>
					</div>
					<div class="row f16" style="padding: 5px 0;">
						<div class="col-md-2 text-right">直播属性：</div>
						<div class="col-md-10">
									{{:tongdao}}
									{{:liuliang}}
									{{:qiehuan}}
									{{:menhu}}
									</div>
					</div>
					<div class="row f16" style="padding: 5px 0;">
						<div class="col-md-2 text-right">播放地址：</div>
						<div class="col-md-10"><a href="{{:playurl}}" class="bt-style3 pointer" style="display: inline-block; color:#fff">点击播放</a></div>
					</div>
					<div class="row f16" style="padding: 5px 0;">
						<div class="col-md-2 text-right">流地址：</div>
						<div class="col-md-10">{{for roominfo.channel}}
										通道类型：{{if channel_type=='output'}}output{{else}}input{{/if}}
										<br>
										推流地址：{{:input}}
										<br>
										<!--rmtp播放地址：
										flv播放地址：
										m3u8播放地址：-->
									{{/for}}</div>
					</div>

				</div>
  </script>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs">
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">直播详情</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="MyLive">

		    </div>

		  </div>
		</div>
	</div>
</div>
  <script>
	  $(function(){
		  var rendDataObj = new renderData();
		  var getDataObj = new getData();
		  getDataObj.getMyLiveView(<?=$live_id?>,function(result) {
			  console.log(result);
			  var u_data = result.data;
			  var template = $.templates("#liveView");
			  var htmlOutput = template.render(u_data);
			  $("#MyLive").html(htmlOutput);
			  // renderDataObj.renderCause();
		  })
	  })
  </script>

