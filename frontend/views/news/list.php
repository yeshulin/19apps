<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = '课程列表';
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerJsFile('@web/mlv/js/render-data.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerJsFile('@web/mlv/js/data/bcedfa6894732351041978e9817d3de5.js');
?>

<div style="margin-top: 50px;margin-bottom: 50px;">
	<div class="inner clearfix">
		<div id="course-Catelog-Template" class="l border-style1" style="width: 265px;padding-bottom: 40px;padding-left: 20px;padding-right: 15px;">
			<script  id="course-Catelog" type="text/x-jsrender">
				<dl class="title-a-dl">
					<dt>{{:lab}}</dt>
					<dd>
						{{:Cates}}
					</dd>
				</dl>
			</script>
			<h2 class="f18 color-style1 border-b-st1 fw-n" style="padding-top: 10px;padding-bottom: 5px;">全部分类</h2>

		</div>
		<div class="r" style="width: 895px;">
			<div class="border-style1 f14" style="height: 50px;line-height: 50px;padding-left: 20px;">	
				<span class="color-style3 f16" style="border-right: 1px solid #ccc;padding-right: 30px;">排列方式</span>
				<a class="course-order" data-key="create_at" class="h-9-st1" style="margin-left: 30px;" href="#"><i class="icon-caret-down"></i> 按发布时间</a>
				<a class="course-order" data-key="learnnumber" class="h-9-st1" style="margin-left: 30px;" href="#"><i class="icon-caret-down"></i> 按学习人数</a>
				<a class="course-order" data-key="likenumber" class="h-9-st1" style="margin-left: 30px;" href="#"><i class="icon-caret-down"></i> 按喜欢人数</a>
			</div>
			<div>
				<script id="course-dl-list" type="text/x-jsrender">
					<dl>
						<dt>
							<a target="_blank" href="{{:href}}"><img src="{{:goods_thumb}}" alt=""></a>
						</dt>
						<dd>
							<h4><a target="_blank" href="{{:href}}">{{:goods_name}}</a></h4>
							<p class="clearfix">
								<span class="l"><i class="icon-time"></i><em>{{:count_knows_num}}</em></span>
								<span class="r"><i class="icon-user"></i><em>{{:learnnumber}}</em></span>
							</p>
						</dd>
					</dl>
				</script>
				<div class="cause-style3">
<!--					<div id="user-myCause" class="clearfix" style="margin-left: -20px;margin-top: 12px;">-->
<!---->
<!--					</div>-->
					<div id="course-list-index" class="clearfix" style="margin-left: -20px;margin-top: 12px;">

					</div>

		</div>
			
			</div>
			<div id="page">
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
$(function(){
	var search = <?= yii\helpers\Json::encode($list)?>;

	var configId = search["config"];

	function returnConfigId()
	{
		var config = '';
		$("#course-Catelog-Template").find(".act").each(function(){
			var _key = $(this).attr("key");
			if (_key != 0)
			{
				config = config ? config +','+_key : _key;
			}
		});
		return config;
	}

	function returnWhere(search)
	{
		var where = [];
		search["config"] = returnConfigId();
//		console.log(1);
		for (k in search)
		{
			where.push(k+"="+search[k]);
		}
//		search.each(function(k, v){
//			console.log(k);
//			where.push(k+"="+v);
//		});
//		console.log(2);
//		console.log(search);
		return where;
	}

	$.each(CourseConf[1], function(k, v) {
		var Cates='<a class="config" key="0" href="javascript:void(0);">不限</a>';
		if (v.items.length != 0)
		{
//			console.log(v.items);
			var x;
			for (x in v.items)
			{
				Cates += '<a class="config" key="'+v.items[x].course_config_id+'" href="javascript:void(0);">'+ v.items[x].name+'</a>'
			}
		}
		var data = {
			lab:v.name,
			Cates:Cates
		}
		var template = $.templates("#course-Catelog");
		var htmlOutput = template.render(data);
		$("#course-Catelog-Template").append(htmlOutput);
	});
	$('.config[key="0"]').addClass("act");
	if (configId != "" && configId != undefined)
	{
		configId = configId.split(",");
		$.each(configId, function(k, v){
			var _Object = $('.config[key="'+v+'"]');
			_Object.siblings().removeClass("act");
			_Object.addClass("act");
		})
	}

	$(".config").on("click", function(){
		if ($(this).siblings().hasClass("act")){
			$(this).siblings().removeClass("act")
		}
		$(this).addClass("act");
//		console.log(search);
		var where = returnWhere(search);
//		console.log(where);
		CourseList(9,1,$("#course-list-index"),{
			page_target : "#page",
			page_btFn : "CourseList"
		},where);
	});

	$(".course-order").on("click", function(){
		var data_key = $(this).attr("data-key"), key = $(this).attr("key");
		if (key == undefined || key == 0){
			$(this).attr("key", 1);
			$(this).find("i").addClass("icon-caret-up").removeClass("icon-caret-down");
		}else{
			$(this).attr("key", 0);
			$(this).find("i").addClass("icon-caret-down").removeClass("icon-caret-up");
		}
		search["config"] = returnConfigId();
		search[data_key] = $(this).attr("key");
//			console.log(search);
		var where = returnWhere(search);
		CourseList(9,1,$("#course-list-index"),{
			page_target : "#page",
			page_btFn : "CourseList"
		},where);
	});
	var where = returnWhere(search);
	CourseList(9,1,$("#course-list-index"),{
		page_target : "#page",
		page_btFn : "CourseList"
	},where);


	function CourseList(pagesize,current,target,pageObj,where)
	{
		var rendDataObj = new renderData();
		var getDataObj = new getData();
//		console.log(where);
		getDataObj.getGoodsList('course',pagesize,current,function(result){
			var _datas = result.data, _data = _datas.data, htmlOutput="";
			if (_data.length != 0) {
				var u_data = $.map(_data,function(n){
					return {
						goods_thumb:n.goods_thumb,
						count_knows_num:n.course.count_knows_num,
						learnnumber: n.course.learnnumber,
						href: '<?= Url::to(['/site/goods', 'id'=>''])?>'+n.goods_id,
						goods_name:n.goods_name.substring(0, 15),
					};
				});
				var template = $.templates("#course-dl-list");
				htmlOutput = template.render(u_data);
//				target.html(htmlOutput);

			}
			var _pageObj = $.extend(pageObj,{
				currentPage:_datas.currentPage,
				pageSize:_datas.pageSize,
				total:_datas.total,
				dataTarget : target,
				callback:function(index) {
					CourseList(9,index.getCurrent(),$("#course-list-index"),{
						page_target : "#page",
						page_btFn : "CourseList"
					}, returnWhere(search));
				}
			});
			//				console.log(_pageObj);
			//				console.log(_data);
			rendDataObj.renderPageModel(_pageObj);
			target.html(htmlOutput);
		},where);
	}


})
</script>