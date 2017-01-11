  <?php
    use yii\helpers\url;
    ?>
 <?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');    
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
 ?>
<div class="user-content">
	<div class="user-main-box">
		<!--		<a href="#">我的全部课程<font>&nbsp;&gt;</font></a>-->
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
					  <h4><a href="#">{{:title}}</a></h4>
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
				<div id="user-myCause-page"></div>
		    </div>
			  <div class="am-tab-panel am-fade" id="tab2">
				  <ul class="user-content-course clearfix" id="user-myCause-collect">

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
	getMycause(6, 1, $("#user-myCause"), {
		page_target : "#user-myCause-page",
		page_btFn : "getMycause"
	});
	getMycauseCollect(6, 1, $("#user-myCause-collect"), {
		page_target : "#user-myCause-collect-page",
		page_btFn : "getMycauseCollect"
	});
})
</script>