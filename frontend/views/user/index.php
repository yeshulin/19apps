  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
<div class="user-content">
	<div class="user-main-box">
		<a href="<?= Url::to("/user/default/mycourse") ?>">我的全部课程<font>&nbsp;&gt;</font></a>
		<div class="am-tabs" data-am-tabs>			
				<ul class="am-tabs-nav am-nav am-nav-tabs">					
					<div class="l">我的课程</div>
				    <li class="am-active"><a href="#tab1">正在学习</a></li>
				    <li><a href="#tab2">我的收藏</a></li>		 
				</ul>					 
		  <div class="am-tabs-bd">
			  <script id="course-dl-list" type="text/x-jsrender">
				  <li>
					  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
					  <h4><a href="{{:href}}">{{:title}}</a></h4>
					  <p><i class="icon-eye-open"></i><span>已学习{{:doneSum}}个课时</span></p>
				  </li>
			  </script>
			  <script id="course-collect-dl-list" type="text/x-jsrender">
				  <li>
					  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
					  <h4><a href="#">{{:title}}</a></h4>
					  <p class="clearfix">
						<span class="l"><i class="icon-time"></i><em>{{:count_knows_num}}</em></span>
						<span class="r"><i class="icon-user"></i><em>{{:learnnumber}}</em></span>
					</p>
				  </li>
			  </script>
		    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
		      <ul class="user-content-course clearfix" id="user-myCause">

		      </ul>
		    </div>
		    <div class="am-tab-panel am-fade" id="tab2">
		      <ul class="user-content-course clearfix" id="user-myCause-collect">

		      </ul>
		    </div>		   
		  </div>

		
		</div>

	</div>
	<div class="user-main-box" style="margin-top: 10px;">
		<a href="<?= Url::to("/user/live/index") ?>">我的直播<font>&nbsp;&gt;</font></a>
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
							<p>{{:tongdao}}{{:liuliang}}{{:qiehuan}}{{:menhu}}</p>
							<h4><a href="/user/live/view?live_id={{:live_id}}">了解详情</a></h4>
						</li>
				</script>
					<ul class="user-content-course clearfix" id="user-myLive">

					</ul>

				</div>
				<div class="am-tab-panel am-fade" id="tab2">
					<script id="user-Mylive-script" type="text/x-jsrender">
					  <li>
						  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
						  <h4><a href="{{:href}}">{{:title}}</a></h4>
						  <p><i class="icon-eye-open"></i><span></span></p>
					  </li>
				  </script>
					<ul class="user-content-course clearfix" id="user-Mylive-collect">

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="user-main-box" style="margin-top: 10px;">
		<a href="<?= Url::to("/user/lab/index") ?>">我的实验室<font>&nbsp;&gt;</font></a>
		<div class="am-tabs" data-am-tabs>
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">我的实验室</div>
				<li class="am-active"><a href="#tab1">使用实验室</a></li>
				<li><a href="#tab2">我的收藏</a></li>
			</ul>
			<div class="am-tabs-bd">
				<div class="am-tab-panel am-fade am-in am-active" id="tab1">
						<script id="lab-list" type="text/x-jsrender">

					<li>
								<a href="{{:lab_url}}" target="_blank"><img src="{{:goods_thumb}}" alt="{{:lab_name}}"></a>
								<p><i class="icon-time"></i><span>{{:end_time}}</span></p>
								<h4><a href="{{:lab_url}}" target="_blank">{{:lab_name}}</a></h4>
							</li>

				</script>
						<ul class="user-content-course clearfix" id="user-myLab">

						</ul>


				</div>
				<div class="am-tab-panel am-fade" id="tab2">
					<script id="user-Mylab-script" type="text/x-jsrender">
					  <li>
						  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
						  <h4><a href="{{:href}}">{{:title}}</a></h4>
						  <p><i class="icon-eye-open"></i><span></span></p>
					  </li>
				  </script>
					<ul class="user-content-course clearfix" id="user-Mylab-collect">

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="user-main-box" style="margin-top: 10px;margin-bottom: 10px;">
		<a href="<?= Url::to("/user/practical/index") ?>">我的实训平台<font>&nbsp;&gt;</font></a>
		<div class="am-tabs" data-am-tabs>
			<ul class="am-tabs-nav am-nav am-nav-tabs">
				<div class="l">我的实训平台</div>
				<li class="am-active"><a href="#tab1">使用实训平台</a></li>
				<li><a href="#tab2">我的收藏</a></li>
			</ul>
			<div class="am-tabs-bd">
				<div class="am-tab-panel am-fade am-in am-active" id="tab1">
					<script id="pra-list" type="text/x-jsrender">

					<li>
								<a href="{{:practical_url}}" target="_blank"><img src="{{:goods_thumb}}" alt="{{:lab_name}}"></a>
								<p><i class="icon-time"></i><span>{{:end_time}}</span></p>
								<h4><a href="{{:practical_url}}" target="_blank">{{:practical_name}}</a></h4>
							</li>

				</script>
					<ul class="user-content-course clearfix" id="user-myPra">

					</ul>


				</div>

				<div class="am-tab-panel am-fade" id="tab2">
					<script id="user-Mypractical-script" type="text/x-jsrender">
					  <li>
						  <a href="{{:href}}"><img src="{{:img}}" alt=""></a>
						  <h4><a href="{{:href}}">{{:title}}</a></h4>
						  <p><i class="icon-eye-open"></i><span></span></p>
					  </li>
				  </script>

					<ul class="user-content-course clearfix" id="user-Mypractical">
					</ul>
				</div>
			</div>
		</div>
	</div>

<!--	<div id="page">-->
<!--	-->
<!--			-->
<!--	</div>-->
</div>
<script type="text/javascript">
	var rendDataObj = new renderData();
	var getDataObj = new getData();
	function getMycause(pagesize,current,target,pageObj)
	{
		getDataObj.getMycause(pagesize,current,function(result){
			var _datas = result.data;
			var u_data = $.map(result.data.data,function(n){
				if (n.course == null) {
					return {};
				}
				return {
					img : n.course.thumb?n.course.thumb:urlPre+"/mlv/img/temp/asd8972143912.png",
					title : n.course.course_name?n.course.course_name:"课程名待定",
					doneSum : n.xueCourseNum?n.xueCourseNum:"0",
					type: '1',
					href: '<?= Url::to(['/site/course/play', 'id'=>''])?>'+(n.learnKnows?n.learnKnows:"0")
//					href: '<?//= Url::to(['/site/goods', 'id'=>''])?>//'+(n.goods_id?n.goods_id:"0")
//				countDown : n.course.countDown?n.course.countDown:"017-06-06  00:00:00",
//				compuSum : n.course.compuSum?n.course.compuSum:"0"
				};
			});
			if (u_data.length != 0) {
				var template = $.templates("#course-dl-list");
				target.html(template.render(u_data));
			}
		});
	}

	function getMycauseCollect(pagesize,current,target,pageObj)
	{
		getDataObj.getMyCollect('course', pagesize, current, function (result) {
			var _datas = result.data;
			var u_data = $.map(_datas.data, function (n) {
				if (n.items == null) {
					return {};
				}
				return {
					img: n.items.thumb ? n.items.thumb : urlPre + "/mlv/img/temp/asd8972143912.png",
					title: n.items.course_name ? n.items.course_name : "课程名待定",
					type: '1',
					href: '<?= Url::to(['/site/goods', 'id'=>''])?>'+n.goods_id,
					count_knows_num : n.items.count_knows_num?n.items.count_knows_num:"0",
					learnnumber : n.items.learnnumber?n.items.learnnumber:"0"
				};
			});
			if (u_data.length != 0) {
				var template = $.templates("#course-collect-dl-list");
				target.html(template.render(u_data));
			}
		});
	}

	function getLiveCollect(pagesize,current,target,pageObj)
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
				var template = $.templates("#user-Mylive-script");
				target.html(template.render(u_data));

			}
		});
	}
	function getLabCollect(pagesize,current,target,pageObj)
	{
		getDataObj.getMyCollect('lab', pagesize, current, function (result) {
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
				var template = $.templates("#user-Mylab-script");
				target.html(template.render(u_data));
			}
		});
	}
	function getPracticalCollect(pagesize,current,target,pageObj)
	{
		getDataObj.getMyCollect('practical',pagesize, current, function (result) {
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
				var template = $.templates("#user-Mypractical-script");
				target.html(template.render(u_data));
			}
		});
	}


$(function(){
	getMycause(3, 1, $("#user-myCause"));
	getMycauseCollect(3, 1, $("#user-myCause-collect"));
	getLiveCollect(3, 1, $("#user-Mylive-collect"));
	getLabCollect(3, 1, $("#user-Mylab-collect"));
	getPracticalCollect(3, 1, $("#user-Mypractical"));
})
	getDataObj.getLabList(function(result){
		var u_data = $.map(result.data,function(n){
			//console.log(n);

			n.begin_time=formatDate(n.begin_time);
			n.end_time=formatDate(n.end_time);
			return n;
		});
		//console.log(u_data);
		if (u_data.length != 0) {
			var template = $.templates("#lab-list");
			var htmlOutput = template.render(u_data);
			$("#user-myLab").html(htmlOutput);
		}
	});
	getDataObj.getPracticalList(function(result){
		var u_data = $.map(result.data,function(n){
			//console.log(n);

			n.begin_time=formatDate(n.begin_time);
			n.end_time=formatDate(n.end_time);
			return n;
		});
		//console.log(u_data);
		if (u_data.length != 0) {
			var template = $.templates("#pra-list");
			var htmlOutput = template.render(u_data);
			$("#user-myPra").html(htmlOutput);
		}
	});
	getDataObj.getMyLiveList(function(result){
		//console.log(result);
		var u_data = $.map(result.data,function(n){
			//console.log(n);

			n.begin_time=formatDate(n.begin_time);
			n.end_time=formatDate(n.end_time);
			return n;
		});
		if (u_data.length != 0) {
			var template = $.templates("#live-list");
			var htmlOutput = template.render(u_data);
		console.log(htmlOutput);
			$("#user-myLive").html(htmlOutput);
		}
	});
</script>


<script>
//	var rendDataObj = new renderData();
//	var getDataObj = new getData();
//
//	function doData1(pagesize,current,target,pageObj){
//			getDataObj.getMycause(pagesize,current,function(result){
//			if (result.data.data.length != 0) {
//
//				rendDataObj.renderCause(target,result,pageObj);
//			}
//		});
//	}
//	function doData2(pagesize,current,target,pageObj){
//			getDataObj.getMycauseCollect(pagesize,current,function(result){
//			if (result.data.data.length != 0) {
//				rendDataObj.renderCause(target,result,pageObj);
//			}
//		});
//	}
//// 	getDataObj.getMycauseCollect(3,1,function(result){
//
//// 		var u_data = $.map(result.data.data,function(n){
//// 			if (n.items == null) {
//// 				return {};
//// 			}
//// 			n = {
//// 				img : n.items.thumb?n.items.thumb:urlPre+"/mlv/img/temp/asd8972143912.png",
//// 				title : n.items.course_name?n.items.course_name:"课程名待定",
//// 				doneSum : n.items.doneSum?n.items.doneSum:"0",
//// 				type: '1',
//// //				countDown : n.course.countDown?n.course.countDown:"017-06-06  00:00:00",
//// //				compuSum : n.course.compuSum?n.course.compuSum:"0"
//// 			}
//// 			return n;
//// 		});
//// 		if (u_data.length != 0) {
//// 			rendDataObj.renderCause($("#user-myCause-collect"), u_data);
//// 		}
//// 	});
//
//$(function(){
//	doData1(3,1,$("#user-myCause"),{
//		page_target : "#page",
//		page_btFn : "doData1"
//	});
//	doData2(3,1,$("#user-myCause-collect"),{
//		page_target : "#page2",
//		page_btFn : "doData2"
//	});
//})
</script>