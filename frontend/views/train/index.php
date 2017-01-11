<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/15
 * Time: 10:30
 */

$this->registerJsFile('@web/mlv/js/idangerous.swiper.min.js');
$this->registerCssFile('@web/mlv/css/idangerous.swiper.css');

$this->title = '技能培训';
use yii\helpers\Url;


?>
<style>
	.wmdys dl{
		float: left;
		width: 199px;
		text-align:center;
	}

	.wmdys dl dd{
		font-size: 16px;
		color: #666;
		margin-top: 20px;
	}
.swiper-style1{
	overflow: hidden;
	position: relative;
}
	.swiper-style1 .swiper-container {
     width: 1252px;
    height: 146px;
    position: relative;
    left: -26px;
}
.swiper-style1 .swiper-slide dl{
  width: 260px;
  height: 146px;
  position: relative;
  margin: auto;
}

.swiper-style1 .swiper-slide dl dt{
	width: 100%;
	height: 28px;
	background:url(<?=Url::to('@web/mlv/img/icon/black-back08.png', true)?>) repeat;
	position: absolute;
	bottom: 0;
	left: 0;
	line-height: 28px;
	text-indent: 7px;
}
.swiper-style1 .swiper-slide dl dt a{
	font-weight: normal;
	color:#fff;
}
.swiper-style1 .swiper-slide dl dd,.swiper-style1 .swiper-slide dl dd img{
	width: 100%;
	height: 100%;
	margin: 0;
}
.swiper-style1 .arrow-left {
    background: url(<?=Url::to('@web/mlv/img/icon/lr-arrow.png', true)?>) no-repeat 0 0;
    position: absolute;
        left: 0px;
    top: 0px;
    width: 40px;
    height: 146px;
}
.swiper-style1 .arrow-right {
    background: url(<?=Url::to('@web/mlv/img/icon/lr-arrow.png', true)?>) no-repeat -1160px 0;
    position: absolute;
    right: 0px;
    top: 0px;
     width: 40px;
    height: 146px;
}
.swiper-style1:hover > a{
	z-index: 10;
}


.swiper-style2{
	overflow: hidden;
	position: relative;
}
.swiper-style2 .swiper-container {
	width: 1200px;
	height: 90px;
}
.swiper-style2 .swiper-slide > div{
	width: 217px;
	height: 90px;
	background: url(<?=Url::to('@web/mlv/img/icon/hzyx-back.png', true)?>) no-repeat 0 0;
	margin: auto;
}
.swiper-style2 .swiper-slide > div img{
	width: 211px;
	height: 82px;
	border:none;
}

.swiper-style3{
	overflow: hidden;
	position: relative;
}
.swiper-style3 .swiper-container {
	width: 1200px;
	height: 90px;
}
.swiper-style3 .swiper-slide > div{
	width: 217px;
	height: 90px;
	background: url(<?=Url::to('@web/mlv/img/icon/hzyx-back.png', true)?>) no-repeat 0 0;
	margin: auto;
}
.swiper-style3 .swiper-slide > div img{
	width: 211px;
	height: 82px;
	border:none;
}
.swiper-style1 .swiper-slide dl:hover dt a{
	 opacity: .7;
}

 
</style>
<div style="height: 550px;background: url(<?=Url::to('@web/mlv/img/temp/banner11.jpg', true)?>) no-repeat top center">
	
</div>
<div >
	<div class="inner">
		<h3 class="f24 text-center color-style1 fw-n" style="padding-top: 40px;">线上直播培训</h3>
		<p class="f14 text-center color-style3 lh24" style="width: 1122px;margin:auto;margin-top: 36px;">为专业传媒机构提供在线直播培训服务，打造行业专属互联网培训系列课程。在线直播培训能够解决分布式员工布局，轮班制工作安排，培训经费有限等问题，用直播、互动等方式使员工对培训产生兴趣，用省时、省钱、更高效的方式解决员工的培训问题。线上直播培训内容涵盖索贝产品培训、媒体云服务管理及技术类培训、媒体运营类培训、互联网营销类培训等。除由华栖云教提供的线上直播培训服务，用户还可定制培训内容，由华栖云教安排导师，提供企业定向直播培训服务。</p>
		<div class="border-style1" style="margin-top: 75px;text-align: center;">
			<span class="f18 color-style2" style="padding: 0 30px;background-color: #fff;position: relative;top: -13px;">我们的优势</span>
			<div class="clearfix wmdys" style="padding-top: 20px;padding-bottom: 20px;">
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon1.png', true)?>" alt=""></dt>
					<dd>直播授课</dd>
				</dl>
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon2.png', true)?>" alt=""></dt>
					<dd>实时互动</dd>
				</dl>
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon3.png', true)?>" alt=""></dt>
					<dd>录播复习</dd>
				</dl>
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon4.png', true)?>" alt=""></dt>
					<dd>真实演练</dd>
				</dl>
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon5.png', true)?>" alt=""></dt>
					<dd>真实评测</dd>
				</dl>
				<dl>
					<dt><img src="<?=Url::to('@web/mlv/img/temp/jnpx-icon6.png', true)?>" alt=""></dt>
					<dd>学习跟踪</dd>
				</dl>
			</div>
		</div>
	</div>
	
</div>
<div style="    background: #f8f8f8;margin-top: 50px;padding-bottom: 50px;border-bottom:1px dashed #cacaca;">
	<div class="inner">
		<h3 class="f24 text-center color-style1 fw-n" style="padding-top: 40px;">线下培训</h3>
		<p class="f16 color-style2" style="margin-top: 45px;">•&nbsp;教师培训</p>
		<p class="f14 color-style3" style="margin-top: 10px;">为高校传媒专业教师提供技能提高培训服务，让教师掌握最新视频制作技能，丰富授课内容。同时，可以了解到传媒行业最前沿传媒技术与发展理念，最新的教学实践实验平台，与传媒专业同行交流教学经验。迄今，华栖云学院已经成功举办了十期教师培训班，来自中国传媒大学、中山大学、浙江传媒学院、四川传媒学院的近200名老师参加了培训。</p>
		<div class="swiper-style1" style="margin-top: 45px;">
		<a class="arrow-left" href="#"></a> 
    <a class="arrow-right" href="#"></a>
			<div class="swiper-container">
    <div class="swiper-wrapper">

		<div class="swiper-slide">
			<dl>
				<dt>
					<a class="color-414448 hover-fe6a00" target="_blank" href="javascript:;">第九期索贝视频工程师教师培训班</a>
				</dt>
				<dd>
					<img src="/uploadfile/2016/0608/20160608063520949.jpg" alt="">
				</dd>
			</dl>
		</div>

		<div class="swiper-slide">
			<dl>
				<dt>
					<a class="color-414448 hover-fe6a00" target="_blank" href="javascript:;">第八期索贝视频工程师教师培训班</a>
				</dt>
				<dd>
					<img src="/uploadfile/2016/0426/20160426020857843.jpg" alt="">
				</dd>
			</dl>
		</div>
		<div class="swiper-slide">
			<dl>
				<dt>
					<a class="color-414448 hover-fe6a00" target="_blank" href="javascript:;">第七期索贝视频工程师教师认证</a>
				</dt>
				<dd>
					<img src="/uploadfile/2015/1102/20151102060305610.jpg" alt="">
				</dd>
			</dl>
		</div>
		<div class="swiper-slide">
			<dl>
				<dt>
					<a class="color-414448 hover-fe6a00" target="_blank" href="javascript:;">第六期索贝视频工程师教师认证</a>
				</dt>
				<dd>
					<img src="/uploadfile/2015/1020/20151020091410320.png" alt="">
				</dd>
			</dl>
		</div>

	</div>
    <div class="pagination"></div>
  </div>
  <script>
  $(function(){
  	var mySwiper = new Swiper('.swiper-style1 .swiper-container',{
    slidesPerView: 4,
    loop: true
  });
  	$('.arrow-left').on('click', function(e){
    e.preventDefault();
    mySwiper.swipePrev();
  })
  $('.arrow-right').on('click', function(e){
    e.preventDefault();
    mySwiper.swipeNext();
  })

  })
  
  </script>

		</div>	
		<div style="margin-top: 45px;">
		<p class="f14 color-style2">合作院校</p>
		<div class="swiper-style2" style="margin-top: 20px;">
			<div class="swiper-container">
			    <div class="swiper-wrapper">
					<div class="swiper-slide">
						<div><img src="<?=Url::to('@web/mlv/img/temp/zgcm.jpg', true)?>" alt=""></div>
					</div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/zjdx.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/sccm.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/cdlg.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/gxdx.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/gzdx.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/hnlg.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/jldx.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/qhdx.jpg', true)?>" alt=""></div>
			      </div>
					<div class="swiper-slide">
						<div><img src="<?=Url::to('@web/mlv/img/temp/zsdx.jpg', true)?>" alt=""></div>
					</div>
			    </div>
			    <div class="pagination"></div>
			  </div>	
		</div>
		 <script>
  $(function(){
  	var mySwiper2 = new Swiper('.swiper-style2 .swiper-container',{
    slidesPerView: 5,
    loop: true,
    autoplay: 5000
  });
  	

  })
  
  </script>
		</div>
	</div>
</div>


<div style="background: #f8f8f8;padding-top: 50px;padding-bottom: 50px;">
	<div class="inner">		
		<p class="f16 color-style2">•&nbsp;电视台培训</p>
		<p class="f14 color-style3" style="margin-top: 10px;">为了方便电视台节目生产人员使用掌握索贝产品快速制作各类型的节目 ，了解最新节目包装风格，提升编辑人员的专业能力，华栖云学院推出了针对电视台节目生产人员的培训服务。同时，还可根据用户需要，提供媒体融合、互动运营等专项内容的定制培训。目前，已经为央视体育混合岛、央视财经频道、西宁广播电视台、沈阳葫芦岛电视台、重庆区县电视台等电视台客户提供培训服务。</p>
		<div style="margin-top: 20px;">
			<img src="<?=Url::to('@web/mlv/img/temp/54566.jpg', true)?>" alt="">
				
		</div>	
		<div style="margin-top: 45px;">
		<p class="f14 color-style2">电视台合作伙伴</p>
		<div class="swiper-style3" style="margin-top: 20px;">
			<div class="swiper-container">
			    <div class="swiper-wrapper">
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/cctv2.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/cctv5.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/hldtv.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/wztv.jpg', true)?>" alt=""></div>
			      </div>
			      <div class="swiper-slide">
			        <div><img src="<?=Url::to('@web/mlv/img/temp/xntv.jpg', true)?>" alt=""></div>
			      </div>
			    </div>
			    <div class="pagination"></div>
			  </div>	
		</div>
		 <script>
  $(function(){
  	var mySwiper3 = new Swiper('.swiper-style3 .swiper-container',{
    slidesPerView: 5,
    loop: true,
    autoplay: 5000
  });
  	

  })
  
  </script>
		</div>
	</div>
</div>
<div class="text-center" style="height: 355px;background: url(<?=Url::to('@web/mlv/img/temp/banner12.jpg', true)?>) no-repeat top center;">
	<h2 class="f24 fw-n color-style0" style="padding-top: 60px;">企业定制培训</h2>
	<p class="f14 lh24" style="color:#d9dfeb;margin-top: 30px;width: 940px;margin-left: auto;margin-right: auto;">如果您未在线上找到您需要的课程，如果您对培训有自己的想法，联系我们。我们将为您提供独家的企业定制培训服务。同时，还可提供定制培训的线上点播学习服务，方便您的员工随时随地的进行学习，任何入职的新员工都可随时加入，培训效率显著提高，培训成本极大节省。</p>
	<a class="bt-style3" style="margin-top: 65px;margin-left: auto;margin-right: auto;" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1665529834&amp;site=学院客服&amp;menu=yes" target="_blank">在线咨询</a>

</div>