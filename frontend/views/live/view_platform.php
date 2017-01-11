<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->title = 'About';


?>
<div class="backimg-text border-b-st1" style="background-image: url(<?=Url::to('@web/mlv/img/temp/banner13.jpg', true)?>);">
	<div class="inner clearfix">
		<div class="l" style="width: 550px;">
			<h2 style="padding-top: 150px;">区域直播平台</h2>
			<p>统一的直播运营平台，最大化的提升直播内容价值。</p>	
		</div>
	</div>
</div>
<div style="padding-top: 38px;">
	<div class="inner">
		<style>
  .scrollspy-nav {
        top: 0;
    z-index: 100;
    background: none;
    width: 100%;
    padding: 0 10px;
    border: 1px solid #ddd;
        background: #fff;
  }

  .scrollspy-nav ul {
    margin: 0;
    padding: 0;
  }

  .scrollspy-nav li {
    display: inline-block;
    list-style: none;
  }

  .scrollspy-nav a {
        color: #666666;
    padding: 10px 20px;
    display: inline-block;
    border-bottom: 1px solid #ddd;
    position: relative;
    top: 1px;
  }

  .scrollspy-nav a.am-active {
    color: #e76f45;
    font-weight: bold;
    border-bottom-color: #e76f45;
  }

  .am-panel {
    margin-top: 20px;
  }

</style>
<nav class="scrollspy-nav" data-am-scrollspynav="{offsetTop: 45}" data-am-sticky>
  <ul>
    <li><a href="#about">产品概述</a></li>
    <li><a href="#func">功能流程</a></li>
    <li><a href="#theme">应用场景</a></li>
    <li><a href="#service">设计我的直播服务</a></li>
  </ul>
</nav>

<div class="am-panel am-panel-default" id="about">
  <div class="am-panel-hd f18">产品概述</div>
  <div class="am-panel-bd">

    <p class="color-style3" style="line-height: 30px;">为每一所学校提供多个直播通道，并建设专属的互联网门户。通过云端切换台，将丰富多彩的学校生活，快速传递给学校老师、学生和家长，让更多人能够实时分享有价值的教育内容。</p>
    <p style="padding-top: 60px;padding-bottom: 100px;"><img src="<?=Url::to('@web/mlv/img/temp/qyzb1.jpg', true)?>" alt=""></p>
  </div>
</div>


<div class="am-panel am-panel-default" id="func">
  <div class="am-panel-hd f18">功能流程</div>
  <div class="am-panel-bd">
    <p class="color-style3" style="line-height: 30px;padding-bottom: 20px;">* 为区域教育机构提供的专属直播服务平台，并由其自主管理和运营。<br>
* 多种终端设备接入，支持手机PGC，E-VK微课直播、E-Studio切换台等直播信号源。<br>
* 多种终端收看直播课程，支持手机App，网站、微信、OTT等终端播放工具。<br>
* 多种直播格式。支持从互联网播放，到高清、超清播放质量的直播。<br>
* 统一门户，为辖区内多所学校共同进行直播内容的检索、呈现和播放<br>
* 基于云端流媒体切换台的直播内容实时筛选<br>
* 海量的存储和带宽，无需担心内容流失或传输效率不足的问题。<br>
* 灵活的付费方式，应对用户对每一次活动、每一堂课程的直播。<br>
* 统一的运营推广接入。与第三方平台、厂商紧密合作，共同推进高价值教育内容的传播。</p>
  </div>
</div>

<div class="am-panel am-panel-default" id="theme">
  <div class="am-panel-hd f18">应用场景</div>
  <div class="am-panel-bd" style="padding: 1.25rem 0;">
    <div class="zbjs-yycj clearfix">
		<dl>
			<dt><img src="<?=Url::to('@web/mlv/img/temp/zbqy-icon1.png', true)?>" alt=""></dt>
			<dd>
				<h4>山村小学教育直播</h4>
				<p>将城区的优质教育资源快速送达偏远地区学校。</p>
			</dd>
		</dl>
		<dl>
			<dt><img src="<?=Url::to('@web/mlv/img/temp/zbqy-icon2.png', true)?>" alt=""></dt>
			<dd>
				<h4>1对N的公开课直播</h4>
				<p>让更多的学校看到并参与公开课的教学活动。</p>
			</dd>
		</dl>
		<dl>
			<dt><img src="<?=Url::to('@web/mlv/img/temp/zbqy-icon3.png', true)?>" alt=""></dt>
			<dd>
				<h4>区域内教师培训</h4>
				<p>以多种互动直播形式，提升教师技能水平。</p>
			</dd>
		</dl>
		<dl>
			<dt><img src="<?=Url::to('@web/mlv/img/temp/zbqy-icon4.png', true)?>" alt=""></dt>
			<dd>
				<h4>大型活动直播</h4>
				<p>在大型活动现场，向区域内所有学校进行直播。</p>
			</dd>
		</dl>
    </div>
  </div>
</div>


<div class="am-panel am-panel-default" id="service" style="visibility: hidden;">
  <div class="am-panel-hd">再见王子</div>
  <div class="am-panel-bd">
        <p></p>
  </div>
</div>



	</div>
</div>

<form method="POST" action="<?=Url::to(['order/confirm'])?>">
<input type="hidden" name="goods[0][goods_id]" value="326">
<input type="hidden" name="goods[0][attr][]" value="TIMETEXT326I100000ILIVE_TD_TIME">
<input type="hidden" name="goods[0][TIMETEXT326I100000ILIVE_TD_TIME]" value="1">


<input type="hidden" name="goods[1][goods_id]" value="350">
<input type="hidden" name="goods[1][attr][]" value="TIMETEXT350I100000ILIVE_QHT_TIME">
<input type="hidden" name="goods[1][attr][]" value="OTHERRADIO350I100000ILIVE_QHT_SERVICE">
<input type="hidden" name="goods[1][OTHERRADIO350I100000ILIVE_QHT_SERVICE]" value="1">


<input type="hidden" name="goods[2][goods_id]" value="344">
<input type="hidden" name="goods[2][attr][]" value="PEOPLETEXT344I50000ILIVE_LLB_RS">
<input type="hidden" name="goods[2][attr][]" value="TIMETEXT344I100000ILIVE_LLB_TIME">
<input type="hidden" name="goods[2][DEFINITIONRADIO344I05000ILIVE_LLB_QXD_1]" value="1">
<input type="hidden" name="goods[2][DEFINITIONRADIO344I10000ILIVE_LLB_QXD_2]" value="1">
<input type="hidden" name="goods[2][DEFINITIONRADIO344I20000ILIVE_LLB_QXD_3]" value="1">
<input type="hidden" name="goods[2][DEFINITIONRADIO344I15000ILIVE_LLB_QXD_4]" value="1">
<input type="hidden" name="goods[2][num]" value="1">

<input type="hidden" name="goods[3][num]" value="1">

<input type="hidden" name="remarks" value="platform">

<div style="height: 618px;background: url(<?=Url::to('@web/mlv/img/temp/banner14.jpg', true)?>) no-repeat top center;">
	<div class="inner">
		<h2 class="color-style0 f24 text-center fw-n" style="padding-top: 50px;padding-bottom: 30px;">设计我的直播服务</h2>
		<div style="width: 1200px;height: 430px;padding: 60px 70px;background: url(<?=Url::to('@web/mlv/img/white-back06.png', true)?>) repeat;">
			<div class="clearfix">
			<div class="l" style="width: 485px;">
				<div class="l f16 color-style5" style="width: 124px;">• 直播通道数量</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
					<input class="color-style0" type="text" name="goods[0][num]" value="1" style="background: none;border: none;position: relative;top: 6px;left: 7px;text-align: center;"></div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(在云教室模式中，默认通道数量为1个)</div>
			</div>	
			<div class="l" style="width: 485px;margin-left: 50px;">
				<div class="l f16 color-style5" style="width: 124px;">• 直播时长</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
					<input class="color-style0" type="text" name="goods[2][TIMETEXT344I100000ILIVE_LLB_TIME]" value="1" style="background: none;border: none;position: relative;top: 6px;left: 7px;text-align: center;"></div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(输入预期直播时间长度，最小计时单位为1小时)</div>
			</div>		
			
			
		</div>
<div class="clearfix" style="margin-top: 30px;">
				<div class="l" style="width: 485px;">
				<div class="l f16 color-style5" style="width: 124px;">• 直播切换台通道</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
					<input class="color-style0" type="text" name="goods[1][num]" value="1" style="background: none;border: none;position: relative;top: 6px;left: 7px;text-align: center;"></div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(输入切换台的输入和输出通道数量)</div>
			</div>	
			
			<div class="l" style="width: 485px;margin-left: 50px;">
				<div class="l f16 color-style5" style="width: 124px;">• 预期观众人数</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
					<input class="color-style0" type="text" name="goods[2][PEOPLETEXT344I50000ILIVE_LLB_RS]" value="1" style="background: none;border: none;position: relative;top: 6px;left: 7px;text-align: center;"></div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(输入预期同时在线观看的用户人数，最低为5人）</div>
			</div>	
		</div>
		<div class="clearfix" style="margin-top: 30px;">
			<div class="l" style="width: 485px;">
				<div class="l f16 color-style5" style="width: 124px;">• 平台使用时长</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
					<input class="color-style0" type="text" name="goods[1][TIMETEXT350I100000ILIVE_QHT_TIME]" value="1" style="background: none;border: none;position: relative;top: 6px;left: 7px;text-align: center;"></div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(输入平台租用时间，按天计算)</div>
			</div>		
			
			
			<div class="l" style="width: 485px;margin-left: 50px;">
				<div class="l f16 color-style5" style="width: 124px;">• 直播质量</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
				<select class="color-style0" name="goods[2][attr][]" style="background: none;border: none;position: relative;top: 6px;left: 55px;
    text-align: center;
    width: 50%;">
					<option class="color-style2" value="DEFINITIONRADIO344I05000ILIVE_LLB_QXD_1">流畅</option>
					<option class="color-style2" value="DEFINITIONRADIO344I10000ILIVE_LLB_QXD_2">标清</option>
					<option class="color-style2" value="DEFINITIONRADIO344I20000ILIVE_LLB_QXD_3">高清</option>
					<option class="color-style2" value="DEFINITIONRADIO344I15000ILIVE_LLB_QXD_4">超清</option>
				</select>
				</div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(选择直播视音频的质量。如：流畅、标清、高清、超清)</div>
			</div>	
		</div>
		<div class="clearfix" style="margin-top: 30px;">
			<div class="l" style="width: 485px;">
				<div class="l f16 color-style5" style="width: 124px;">• 区域门户</div>
				<div class="l" style="width: 159px;height: 33px;background: url(<?=Url::to('@web/mlv/img/icon/blue-back06.png', true)?>) repeat;">
				<select class="color-style0" name="goods[3][goods_id]" style="background: none;border: none;position: relative;top: 6px;left: 55px;
    text-align: center;
    width: 50%;">
					<option class="color-style2" value="359">YES</option>
					<option class="color-style2">NO</option>
				</select>
				</div>
				<div class="l f12 color-style5" style="width: 175px;margin-left: 27px;">(选择是否需要定制区域直播门户)</div>
			</div>		
			
			
		</div>
		<div class="clearfix" style="margin: 60px auto 0px;width: 200px;">
			<button type="submit" class="bt-style3 l">提交配置单</button>
			<!--<a class="bt-style3 l" style="background-color: #fff;color:#333;margin-left: 70px;" href="#">联系专家</a>-->
		</div>
		</div>
		
	</div>

</div>
</form>
<script type="text/javascript">
	$(function(){
		$('input[name="goods[1][TIMETEXT350I100000ILIVE_QHT_TIME]"]').keyup(function(event) {
			$('input[name="goods[0][TIMETEXT326I100000ILIVE_TD_TIME]"]').val($(this).val());
		});
	});
</script>