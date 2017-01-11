  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
<div class="user-content">
	<div class="user-main-box">

		<div class="am-tabs" data-am-tabs>
		<ul class="am-tabs-nav am-nav am-nav-tabs">
					<div class="l">我的直播</div>
				    <li class="am-active"><a href="#tab1">我的直播间</a></li>
				    <li><a href="#tab2">我的收藏</a></li>
				</ul>					 
		  <div class="am-tabs-bd">
		    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
				<script id="live-list" type="text/x-jsrender">
					<li class="zhibolist">
							<div class="thumb"><a href="{{:playurl}}" target="_blank" >{{:live_name}}</a></div>
							<p class="live_class" style="line-height: 20px;margin-top: 5px;">{{:tongdao}}{{:liuliang}}{{:qiehuan}}{{:menhu}}</p>
							<h4><a style="color:#e76f45;font-size: 14px;" href="/user/live/view?live_id={{:live_id}}">查看详情</a></h4>
						</li>
				</script>
				<ul class="user-content-course clearfix" id="user-myLive">

				</ul>

		    </div>
		    <div class="am-tab-panel am-fade" id="tab2">
				<script id="course-dl-list" type="text/x-jsrender">
					  <li>
						  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
						  <h4><a href="{{:href}}">{{:title}}</a></h4>
						  <p><i class="icon-eye-open"></i><span></span></p>
					  </li>
				  </script>
				<ul class="user-content-course clearfix" id="user-Mylab">

				</ul>
				<div id="user-myCause-collect-page"></div>
		    </div>		   
		  </div>
		</div>
	</div>
</div>
  <script>
	 var rendDataObj = new renderData();
	  var getDataObj = new getData();

	  function getLabCollect(pagesize,current,target,pageObj)
	  {
		  getDataObj.getMyCollect('live', pagesize, current, function (result) {
			  var _datas = result.data;
			  var u_data = $.map(_datas.data, function (n) {
				  if (n.items == null) {
					  return {};
				  }
				  return {
					  img: n.items.thumb ? n.items.thumb : urlPre + "/mlv/img/temp/asd8972143912.png",
					  title: n.items.lab_name ? n.items.lab_name : "课程名待定",
					  href: '<?= Url::to(['/site/goods', 'id'=>''])?>'+n.goods_id
//					  doneSum: n.items.doneSum ? n.items.doneSum : "0",
//					  type: '1'
//				countDown : n.course.countDown?n.course.countDown:"017-06-06  00:00:00",
//				compuSum : n.course.compuSum?n.course.compuSum:"0"
				  };
			  });
			  if (u_data.length != 0) {
				  var template = $.templates("#course-dl-list");
				  target.html(template.render(u_data));

				  var _pageObj = $.extend(pageObj,{
					  currentPage:_datas.currentPage,
					  pageSize:_datas.pageSize,
					  total:_datas.total,
					  dataTarget : target
				  });
				  //				console.log(_pageObj);
				  //				console.log(_data);
				  rendDataObj.renderPageModel(_pageObj, target);
			  }
		  });
	  }


	  $(function(){
		  getLabCollect(6, 1, $("#user-Mylab"), {
			  page_target : "#user-myCause-collect-page",
			  page_btFn : "getMycauseCollect"
		  });
		  getDataObj.getMyLiveList(function(result){
			  var u_data = $.map(result.data,function(n){
				  //console.log(n);

				  n.begin_time=formatDate(n.begin_time);
				  n.end_time=formatDate(n.end_time);
				  return n;
			  });
			  //console.log(u_data);
			  if (u_data.length != 0) {
				  var template = $.templates("#live-list");
				  var htmlOutput = template.render(u_data);
				  $("#user-myLive").html(htmlOutput);
			  }
		  });
	  })
  </script>

