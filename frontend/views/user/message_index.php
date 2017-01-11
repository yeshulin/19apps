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
 </style>
  <script id="messageList" type="text/x-jsrender">
<table width="100%"  class="list-style">
					<thead>
					<tr>
						<td>主题</td><td>时间</td><td>操作</td>
					</tr>
					</thead>
					<tbody>
	{{for messageList}}
					  <tr >
	  <td>{{:subject}}</td><td>{{:created_at}}</td><td><a href="/user/message/view?id={{:id}}">浏览</a></td>
	  </tr>
	{{/for}}
	</tbody>
				</table>
	

  </script>
<div class="user-content">
	<div class="user-main-box">
		<div class="am-tabs">			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">我的消息</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="Mymessage">
				
		    </div>

		  </div>
		</div>
	</div>
</div>
  <script>
	  var member = new memberCommon();
	  $(function(){
		  var rendDataObj = new renderData();
		  var getDataObj = new getData();
		  getDataObj.getMymessageList(function(result){
			  var u_data = $.map(result.data.data,function(n){
				  if (n.id == null) {
					  return {};
				  }
				  n.created_at=formatDate(n.created_at);
				  n.content=subString(n.content,20);
				  return n;
			  });
			 console.log(u_data);
			  var _data = {
			  		messageList : u_data
			  }			  

			  if (u_data.length != 0) {
				  var template = $.templates("#messageList");
				  var htmlOutput = template.render(_data);
				  $("#Mymessage").html(htmlOutput);
			  }
		  });

		  // renderDataObj.renderCause();
	  })

  </script>