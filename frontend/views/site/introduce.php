<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Contact';
?>

<style>
	.zyyw-ul{
		    margin-left: -30px;
    margin-top: 35px;
	}
	.zyyw-ul li{
		    width: 370px;
    height: 320px;
    position: relative;
    float: left;
    margin-left: 30px;
    margin-bottom: 23px;
	}
	.zyyw-ul li img{
		position: absolute;
		left: 0;
		top: 0;
	}
		.zyyw-ul li h4{
			font-size: 16px;
    color: #354052;
    font-weight: normal;
    padding-top: 192px;
    position: relative;
    text-align: center;
	}
	.zyyw-ul li p{
			    font-size: 12px;
    line-height: 18px;
    color: #5a6f90;
    font-weight: normal;
    position: relative;
    margin-top: 10px;
    width: 270px;
    margin-left: auto;
    margin-right: auto;		
	}

	.aljs-ul{
		margin-left: -53px;
		margin-top: 30px;
	}
	.aljs-ul li{
		width: 260px;
		float: left;
		margin-left: 53px;
	}
	.aljs-ul li img{
		width: 260px;
		height: 176px;
	}

	.aljs-ul li h4{
			font-size: 16px;
    color: #333;
    font-weight: normal;
    padding: 18px 50px 12px;
    text-align: center;
    line-height: 22px;			
	}
	.aljs-ul li p{
			font-size: 12px;
			line-height: 18px;
			color:#999;
			font-weight: normal;			
	}

</style>
<div style="height: 549px;background: url(<?=Url::to('@web/mlv/img/temp/intro-banner.jpg', true)?>) no-repeat top center;">
	<div class="inner" style="position:relative;overflow: visible">
		<div style="width: 658px; position: absolute;left: 158px;top: 148px;">
			<div><img src="<?=Url::to('@web/mlv/img/temp/intro-icon0.png', true)?>" alt=""></div>
			<p style="border:1px solid #cfecf4;padding: 20px;font-size: 18px;color:#ffffff;line-height: 28px;margin-top: 13px;">
华栖云教，是成都华栖云科技有限公司（阿里巴巴集团与成都索贝数码科技股份有限公司合资成立）的核心业务部门之一，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务。
			</p>
		</div>
	</div>
</div>
<div style="background-color: #eff3f6;padding-top: 80px;padding-bottom: 45px;">
	<div class="inner">
		<h1 class="text-center fw-n f24 color-style1">主营业务</h1>
		<ul class="zyyw-ul clearfix">
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon1.png', true)?>" alt="">
				<h4>云校园解决方案</h4>
				<p>以混合云架构为基础，提供传媒科研教学与运营实训所需的云非编、互动运营、全媒体新闻、课程发布与学习、资源统一管理等实验室和业务平台</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon2.png', true)?>" alt="">
				<h4>云端实验室</h4>
				<p>既能本地私有云建设，也可以直接使用公有云服务的非编、互动发布、新闻制作等实验室，以及配套的专业实验课程</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon3.png', true)?>" alt="">
				<h4>企业实训平台</h4>
				<p>在不影响企业实际生产效率，不占用实际生产系统的情况下，采用与实际系统一直的平台，高效率的进行新老员工的培训与能力提升</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon4.png', true)?>" alt="">
				<h4>教育直播服务</h4>
				<p>利用云端流媒体直播服务，将手机、微课直播工具、教育视频切换台等终端设备所提供的直播信号，向多种终端进行直播推送</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon5.png', true)?>" alt="">
				<h4>教育视频应用</h4>
				<p>基于微课制作工具、精品课录播、切换台、虚拟演播室等设备的教育内容生产制作解决方案，并同时提供直播和精品课内容拍摄制作服务</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon6.png', true)?>" alt="">
				<h4>在线课程</h4>
				<p>依托华栖云教持续不断积累的视音频课程内容，为学校、企业、个人用户，提供多种个性化的在线学习内容和服务平台</p>
			</li>
			<li>
				<img src="<?=Url::to('@web/mlv/img/temp/intro-icon7.png', true)?>" alt="">
				<h4>培训与认证</h4>
				<p>依托国家级权威机构、专业设备提供商、传媒院校，共同提供面向学校、企业、个人的技能培训与专业认证服务</p>
			</li>
		</ul>
	</div>
</div>
<div style="padding-top: 75px;padding-bottom: 90px;">
	<div class="inner">
		<h1 class="text-center fw-n f24 color-style1">案例介绍</h1>
		<ul class="aljs-ul clearfix" >
			<li>
				<div><img src="<?=Url::to('@web/mlv/img/temp/intro-icon8.png', true)?>" alt=""></div>
				<h4>浙江传媒学院媒体融合云平台</h4>
				<p>浙江传媒学院媒体融合云平台是国内首个针对融合媒体实践教学的专属云系统，重点建设了融合媒体综合业务、开放式云工具、发布运营实践、校园融合媒体生产与发布、课程发布与互动学习、统一运营与资源管控六大平台来开展教学与实践，打造“平台+内容+渠道+应用”的高等教育生态圈，全面开启教育行业媒体融合教学与实践新篇章。</p>
			</li>
			<li>
				<div><img src="<?=Url::to('@web/mlv/img/temp/intro-icon9.png', true)?>" alt=""></div>
				<h4>成都理工大学实验教学信息化云平台</h4>
				<p>成都理工大学实验教学信息化云平台旨在实现最佳的教学信息系统化管理，通过平台将教学资料和信息进行数据化，灵活地做到资源信息的共享、分配、使用，提供有效地管理体制以及统计和分析信息。</p>
			</li>
			<li>
				<div><img src="<?=Url::to('@web/mlv/img/temp/intro-icon10.png', true)?>" alt=""></div>
				<h4>深圳大学融媒体新闻仿真实验平台</h4>
				<p>深圳大学融媒体新闻仿真实验平台依托公有云平台，采用仿真实验全流程教学，小步训练、技能分解、实验指导、技能考评，建设融合新闻生产、多终端运营实践、云端专业制作工具等多套融合媒体教学与实践系统，与中央电视台、深圳电视台等行业标杆企业所用业务系统完全一致。</p>
			</li>
			<li>
				<div><img src="<?=Url::to('@web/mlv/img/temp/intro-icon11.png', true)?>" alt=""></div>
				<h4>西北民族大学虚拟实验教学管理云平台</h4>
				<p>西北民族大学虚拟实验教学管理云平台是西北首个公有云虚拟仿真实验教学中心，将课程内容、在线考试以及互动运营搬上云端，形成“视频+测验+实训”三位一体的闭环学习，不仅能还原传统教学场景，还能得到工作场景训练，实现学生即学即练。</p>
			</li>
		</ul>
	</div>
</div>
<div style="height: 335px;background: url(<?=Url::to('@web/mlv/img/temp/intro-banner2.jpg', true)?>) no-repeat top center;">
	<div class="inner">
		<h1 class="f24 text-center fw-n color-style0" style="padding-top: 73px;padding-bottom: 40px;">我们的愿景</h1>
		<p class="f14 text-center" style="line-height: 24px;color:#d9dfeb;">华栖云教致力于培训未来的传媒精英人才，通过媒体校园实验室系统建设及互联网化云校园建设，让学生在校期间，就能体验媒体单位<br>
		的各种生产环境，采用角色化竞赛模式，让学生扮演媒体单位里编辑、记者、编导、主播、运营专员等各种角色，<br>
建立起学校、企业、人才的交流就业通道，让学生即学即用、轻松就业，<br>
让企业招之能战、战则精品。</p>
	</div>
</div>