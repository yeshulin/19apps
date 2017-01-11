<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '在线学习';
// $this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/Swiper-3.3.1/dist/js/swiper.jquery.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerCssFile('@web/mlv/js/Swiper-3.3.1/dist/css/swiper.min.css');
$this->registerJsFile('@web/mlv/js/data/bcedfa6894732351041978e9817d3de5.js');
$this->registerJsFile('@web/mlv/js/data/2e4d25ce0d2c81d9eb1baa01e95f148c.js');
 ?>

<div class="banner-style">	

<div class="swiper-container02">
        <div class="swiper-wrapper">
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>					
	<script id="course-Catelog" type="text/x-jsrender">
		<li>
			<h4><i>&gt;</i>{{:lab}}</h4>
			<p>
				{{:Cates}}
			</p>
			<div class="banner-style-nav-es">
				{{:CatesQ}}
			</div>
		</li>
	</script>
		<div class="banner-style-nav" >
			<ul>

				<h3>
					课程分类
				</h3>
				<div id="course-Catelog-Template">

				</div>
			</ul>
		</div>

</div>

<div id="course-cx" style="padding-top: 37px;padding-bottom: 32px;">
	<div class="inner">
		<div id="course-cuxiao" class="cause-style1 clearfix">

		</div>
	</div>
</div>

<script id="course-inner" type="text/x-jsrender">
<div style="background-color: {{:color}};padding: 50px 0;">
	<div class="inner">
		{{:courseStyle}}
  </div>
</div>
</script>
<script id="course-courseStyle" type="text/x-jsrender">
<div class="cause-style3">
	<h3><a target="_blank" class="r" href="<?=Url::to("/site/course/list")?>">更多&gt;</a>
	<span>{{:lab}}</span>
	{{:aTarget}}
	</h3>
	<div class="clearfix course-list-index" key="{{:key}}" style="margin-left: -20px;margin-top: 12px;">

	</div>
</div>
</script>
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



	<div id="hezuo" style="padding: 50px 0;">
		<div class="inner">
			<h2 style="font-size: 22px;color: #333333;margin-bottom: 30px;font-weight: normal;">合作伙伴</h2>
			<div class="swiper-container swiper-container01">
				<div class="swiper-wrapper  partner clearfix ">			
				
			     
			    </div>
			</div>
			
		</div>

	</div>
</div>
<script type="application/javascript">


$(function(){

	
	$.get('<?= Url::to(['/api/advertisement/get', 'id'=>'18'])?>', function (result) {
		//console.log(result);
		if (result.data !== undefined) {
			$.each(result.data.content, function (k, v) {
				if (v.type == "1") {
					$(".banner-style .swiper-wrapper").append('<div class="swiper-slide">' +
							'<a target="_blank"  style="background-image: url(' + urlPre + v.content + ');"></a>' +
							'</div>');
				}
			})


			 var swiper = new Swiper('.swiper-container02', {
		        // pagination: '.swiper-pagination',
		        // paginationClickable: true
		        autoplay : 5000,
		        loop : true
		    });
		}
	})
	if (CourseConf[1] != undefined)
	{
		var ke_cat = 1;
		$.each(CourseConf[1], function(k, v) {
			var Cates='',CatesQ='';
			if (v.items.length != 0)
			{
				var i = 4;
				for (x in v.items)
				{
					if (i>0)
					{
						Cates += '<a href="<?= Url::to(['list', 'config'=>''])?>' + v.items[x].course_config_id + '"><span>' + v.items[x].name + '</span></a>';
					}
					i--;
					CatesQ += '<p><a target="_blank" href="<?= Url::to(['list', 'config'=>''])?>' + v.items[x].course_config_id + '">' + v.items[x].name + '</a></p>';
				}
			}
			var data = {
				lab: v.name,
				Cates:Cates,
				CatesQ:CatesQ,
			}
			var template = $.templates("#course-Catelog");
			var htmlOutput = template.render(data);
			$("#course-Catelog-Template").append(htmlOutput);
			ke_cat++;
			if (ke_cat > 4) {
				return false;
			}
		});
	}

	if (CourseConf[2] != undefined)
	{
		var i = 1;
		$.each(CourseConf[2], function(k, v) {
			var aTarget = '';
			if (v.items.length != 0)
			{
				$.each(v.items, function(kv, vi){
					aTarget += '<a target="_blank" href="' + encodeURI('<?= Url::to(['course/list', 'courseName'=>''])?>' + vi.name) + '">' + vi.name + '</a>';
				})
			}
			var data = {
				lab: v.name,
				aTarget:aTarget,
				key: v.course_config_id
			};
			var htmlOutput = $.templates("#course-courseStyle").render(data);
			data = {
				courseStyle: htmlOutput,
				color: (i%2 == 1) ? "#f4f4f4" : '#fff'
			};
			htmlOutput = $.templates("#course-inner").render(data);
//	console.log(htmlOutput);
			$("#course-cx").after(htmlOutput);
			i ++;
		})
	}

	$("#hezuo").css("background-color", ((i%2 == 1) ? "#f4f4f4" : '#fff'));
	$('.course-list-index').each(function() {
		var thisObj = $(this);
		var _key = thisObj.attr("key");
		var getDataObj = new getData();

		getDataObj.getGoodsList('course',4,1,function(result){
			var _data = result.data.data,htmlOutput = '';

			if (_data.length != 0) {
				var u_data = $.map(_data,function(n){
					return {
						goods_thumb:n.goods_thumb,
						count_knows_num:n.course.count_knows_num,
						learnnumber: n.course.learnnumber,
						href: '<?= Url::to(['/site/goods', 'id'=>''])?>'+n.goods_id,
						goods_name:n.goods_name,
					};
				});
				var template = $.templates("#course-dl-list");
				htmlOutput = template.render(u_data);
			}
			thisObj.html(htmlOutput);
		},['config='+_key, 'index']);
	})

	$.each([24,23,22,21], function(k, v){
		$.get('<?= Url::to(['/api/advertisement/get', 'id'=>''])?>'+v, function(result){
			if (result.data !== undefined)
			{
				if (result.data.content[0].type == 1){
					$("#course-cuxiao").append('<dl> <dt><a target="_blank" href="'+result.data.content[0].url+'">' +
							'<img src="'+urlPre+result.data.content[0].content+'" alt="">' +
							'</a></dt><dd><a target="_blank" href="'+result.data.content[0].url+'">'+result.data.display_name+'</a></dd></dl>');
				}
			}
		});
	})
	if (Link1 != undefined)
	{
		$.each(Link1, function(k, v){
			if (v.logo != undefined)
			{
				$("#hezuo").find(".partner").append('<a class="swiper-slide" target="_blank" href="'+ v.url+'"><img src="'+ v.logo+'" alt="'+ v.name+'"></a>');
			}
			//合作伙伴
			swiper01 = new Swiper('.swiper-container01', {
		        slidesPerView: 5,
		        loop: true,
		        autoplay: 3000
		    });
		})
	}

})
</script>
<style>

 .banner-style .swiper-container {
        width: 100%;
        height: 330px;
    }
    .banner-style .swiper-slide {
       height: 330px;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .banner-style .swiper-slide a{
    	display: block;
    	width: 100%;
    	height: 330px;
    	background-repeat: no-repeat;
    	background-position: top center;
    }
</style>
