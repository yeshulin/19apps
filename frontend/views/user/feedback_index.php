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
  <script id="feedbackList" type="text/x-jsrender">
<table width="100%"  class="list-style">
			<thead>
					<tr>
						<td>内容</td><td>时间</td><td>操作</td>
					</tr>
					</thead>
					<tbody>
	{{for feedbackList}}
					  <tr >
	  <td>{{:content}}</td><td>{{:created_at}}</td><td><a href="/user/feedback/view?id={{:id}}">浏览</a>&nbsp;&nbsp;<a href="javascript:deladd({{:id}})">删除</a></td>
	  </tr>
	{{/for}}
	</tbody>
				</table>
	

  </script>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?=Url::to("/user/feedback/add")?>">立即反馈<font>&nbsp;&gt;</font></a>
		<div class="am-tabs">			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">我的反馈</div>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="Myfeedback">
				
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
		  getDataObj.getMyfeedbackList(function(result){
			  var u_data = $.map(result.data.data,function(n){
				  if (n.id == null) {
					  return {};
				  }
				  n.created_at=formatDate(n.created_at);
				  n.content=subString(n.content,20);
				  return n;
			  });
			  //console.log(u_data);
			  var _data = {
			  		feedbackList : u_data
			  }			  

			  if (u_data.length != 0) {
				  var template = $.templates("#feedbackList");
				  var htmlOutput = template.render(_data);
				  $("#Myfeedback").html(htmlOutput);
			  }
		  });

		  // renderDataObj.renderCause();
	  })

	  function deladd(id){
		  var E_data =  {
			  "id": id
		  };
		  member.feedbackdel(JSON.stringify(E_data),function(result){
			  //console.log();
			  //console.log(result);
			  if (result.msg == "success") {
				  //sobeyAlert("删除成功！");
				  window.location.reload();
			  }
		  });

	  }
  </script>