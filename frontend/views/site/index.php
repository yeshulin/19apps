<?php
	use yii\helpers\Url;
	
	 $this->registerJsFile('@web/mlv/js/Swiper-3.3.1/dist/js/swiper.min.js');    
	 $this->registerJsFile('@web/mlv/js/sobeyPlug-in.js');   
	 $this->registerCssFile('@web/mlv/js/Swiper-3.3.1/dist/css/swiper.min.css');
     $this->registerCssFile('@web/mlv/css/animate.css');
     $this->registerCssFile('@web/mlv/css/index.css');
?>
<div class="index-main">
	 <div class="swiper-container">
        <div class="swiper-wrapper index-main-swiper" >
             <!-- 华栖云教 -->
            <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content index-swiper-main" style="background-image:url(<?=Url::to('@web/mlv/img/index/yunjiao-01.png', true)?>)" >
                    <div class="index-swiper-top "> 
                    <h1 >华栖云教1</h1>
                    <p>华栖云教，是成都华栖云科技有限公司的核心业务，承担着面向教育行业进行媒体混合云服务的业务拓展，提供云端教学、实训、直播等云服务的核心任务，通过在线课程、技能培训、专业认证、教育直播、云端实验室、企业实训、云校园综合解决方案等多种产品，为教育机构和从业人员，提供无处不在、随时可用的专业云服务</p>
                     
                     </div>
                     <img src="<?=Url::to('@web/mlv/img/index/yunjiao-02.png', true)?>"  class="yunjiao-img" alt="">
                    <div class="index-yunjiao-bot clearfix">
                        <div>
                            <img src="<?=Url::to('@web/mlv/img/index/yunjiao-03.png', true)?>" alt="">
                            <h2 class="f30">我们的愿景</h2>
                            <p>与您一起共同建设基于云服务的 <br>专业教育生态圈 </p>
                        </div>
                        <div>
                            <img src="<?=Url::to('@web/mlv/img/index/yunjiao-04.png', true)?>" alt="">
                            <h2 class="f30">我们的使命</h2>
                            <p>为教育行业的参与者提供无处不在的 <br>专业云服务  </p>
                        </div>
                        <div class="last">
                            <img src="<?=Url::to('@web/mlv/img/index/yunjiao-05.png', true)?>" alt="">
                            <h2 class="f30">我们的服务</h2>
                            <p>在线学习 . 教育直播 . 云端实验室  .<br>
企业实训 . 培训认证
 </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 在线学习 -->
            <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content clearfix">
                    <div class="index-swiper-top"> 
                        <h1 class="f36">[ 在线学习 ]</h1>
                        <p style="
            max-width: 1000px;
        ">1,000+专业课程，40,000+在线师生，与你共同学习，一起进步
        </p>
                         <a href="<?=Url::to("/site/course")?>">了解详情＞</a>
                    </div>
                    <div style="background-image:url(<?=Url::to('@web/mlv/img/index/xuexi-01.png', true)?>)" class="index-xuexi-warp">
                     <div class="index-swiper-bot index-xuexi-bot clrearfix" >
                        <div >
                            <h3 class="line">
                                <img src="<?=Url::to('@web/mlv/img/index/xuexi-02.png', true)?>" style="margin-right:20px;"alt="">
                            <span class="f24">广电制播 </span>
                        </h3>
                            <p>索贝单机非编 <br>    
                        索贝网络非编NOVA  <br>
                        索贝新闻文稿Infoshare <br>
                        虚拟演播室 <br>索贝媒资Mamspace</p>
                        </div>
                        <div >
                            <h3 class="line"><img src="<?=Url::to('@web/mlv/img/index/xuexi-03.png', true)?>" alt="">
                            <span class="f24">互联网/IT技术 </span></h3>
                            <p>互联网营销 <br>互联网产品经理 <br>云计算架构设计 <br>网络规划</p>
                        </div>
                        <div  style="width:275px;">
                            <h3><img src="<?=Url::to('@web/mlv/img/index/xuexi-04.png', true)?>" alt="">
                            <span class="f24">影视行业技术 </span></h3>
                            <p>栏目包装，频道包装，影视包装... <br>影视合成，特效合成... <br>新闻剪辑，节目剪辑...</p>
                        </div>
                        <div >
                            <h3><img src="<?=Url::to('@web/mlv/img/index/xuexi-05.png', true)?>" alt="">
                            <span class="f24">3D动画</span></h3>
                            <p>
                                原画设计 <br>
                                模型设计 <br>
                                灯光材质 <br>
                                动画设定</p>
                        </div>
                        <div >
                            <h3><img src="<?=Url::to('@web/mlv/img/index/xuexi-06.png', true)?>" alt="">
                            <span class="f24">融合媒体
                </span></h3>
                                            <p>
                                                融合新闻 <br>
                融合发布 <br>
                媒体互动运营</p>
                        </div>
                        
                    </div>

                        
                    </div>
                  

                </div>

            </div>
            <!-- 直播 -->
            <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content">
                    <div class="index-swiper-top"> 
                    <h1 class="f36">[ 直播课堂 ]</h1>
                    <p>让每一位老师，每一间教室和每一所学校，都能以更直接的方式，来呈现自己的与众不同</p>
                     <a href="<?=Url::to("/site/live")?>">了解详情＞</a>
                    </div>
                <img src="<?=Url::to('@web/mlv/img/index/zhibo-01.png', true)?>" class="index-zhibo-img" alt="直播课堂" title="直播课堂">
                <div class="index-swiper-bot index-zhibo-bot">
                    <div class=" index-zhibo clearfix">
                        <h3 class="line"><img src="<?=Url::to('@web/mlv/img/index/zhibo-02.png', true)?>" alt="">
                        <span class="f24">聚焦教育</span></h3>
                        <p>为课程、教室、学校、区域教育机构，提供符合其特定需求的直播服务</p>
                    </div>
                    <div class="index-zhibo clearfix">
                        <h3 class="line"><img src="<?=Url::to('@web/mlv/img/index/zhibo-03.png', true)?>" alt="">
                        <span class="f24">平台先进</span></h3>
                        <p>依托阿里云遍布国内的计算资源，超过500个CDN节点，以及华栖云的先进媒体云技术服务</p>
                    </div>
                    <div class="index-zhibo clearfix">
                        <h3><img src="<?=Url::to('@web/mlv/img/index/zhibo-04.png', true)?>" alt="">
                        <span class="f24">即买即用</span></h3>
                        <p>授权认证用户，通过在线付款，无需长时间等待，即可开通云端直播服务</p>
                    </div>
                    
                </div>
                </div>

            </div>
            <!-- 实验室 -->
            <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content clearfix">
                    <div class="index-swiper-top"> 
                        <h1 class="f36">[ 云端实验室 ]</h1>
                        <p>紧跟行业发展趋势，打造依托媒体云服务的前沿技术与业务实验室
                  </p>
                         <a href="<?=Url::to("/site/lab")?>">了解详情＞</a>
                    </div>
                    <div style="background-image:url(<?=Url::to('@web/mlv/img/index/shiyanshi-01.png', true)?>)" class="index-shiyanshi-warp">
                     <div class="index-swiper-bot index-shiyanshi-bot " style="background-image:url(<?=Url::to('@web/mlv/img/index/shiyanshi-06.png', true)?>)">
                        <div class=" index-zhibo clearfix">
                            <h3 class="line">
                                <img src="<?=Url::to('@web/mlv/img/index/shiyanshi-02.png', true)?>" style="margin-right:20px;"alt="">
                            <span class="f24">企业业务流程仿真</span>
                        </h3>
                            <p>· 中央电视台 <br>    
                        · 浙江电视台 <br>
                        · 深圳卫视</p>
                        </div>
                        <div class="index-zhibo clearfix">
                            <h3 class="line"><img src="<?=Url::to('@web/mlv/img/index/shiyanshi-03.png', true)?>" alt="">
                            <span class="f24">配套课程体系</span></h3>
                            <p>· 媒体运营实践与应用 <br>
                    · 节目制作实践与应用 <br>
                    · 融合发布实践与应用</p>
                        </div>
                        <div class="index-zhibo clearfix">
                            <h3><img src="<?=Url::to('@web/mlv/img/index/shiyanshi-04.png', true)?>" alt="">
                            <span class="f24">业内专业工具 </span></h3>
                            <p>· WEBTV <br>
                    · NOVA <br>
                    · 微信发布互动</p>
                        </div>
                        <div class="index-zhibo clearfix">
                            <h3><img src="<?=Url::to('@web/mlv/img/index/shiyanshi-05.png', true)?>" alt="">
                            <span class="f24">敬请期待...  </span></h3>
                            <p>· 全媒体实验室
                             <br>
                            · 大数据实验室
                             <br>
                            · 云架构实验室</p>
                        </div>
                        
                    </div>

                        
                    </div>
                  

                </div>

            </div>
            <!-- 实训 -->
             <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content">
                    <div class="index-swiper-top"> 
                    <h1 class="f36">[ 企业实训 ]</h1>
                    <p>与企业生产系统完全相同，但又与传统培训模式完全不同的员工培训云平台</p>
                     <a href="<?=Url::to("/site/practical")?>">了解详情＞</a>
                </div>
                <img src="<?=Url::to('@web/mlv/img/index/shixun-01.png', true)?>" class="index-shixun-img" alt="企业实训" title="企业实训">
                <img src="<?=Url::to('@web/mlv/img/index/shixun-02.png', true)?>" class="index-shixun-img02" alt="企业实训" title="企业实训">
                </div>

            </div>
             <!-- 技能培训 -->
             <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content clearfix">
                    <div class="index-swiper-top"> 
                        <h1 class="f36">[ 技能培训 ]</h1>
                        <p>线上（Online）与线下（Offline）相结合的专业技能培训服务
</p>
                         <a href="<?=Url::to("/site/train")?>">了解详情＞</a>
                    </div>
                   
                     <div class="index-swiper-bot index-jineng-bot clearfix" style="background-image:url(<?=Url::to('@web/mlv/img/index/jineng-01.png', true)?>)">
                        <div class="l index-jineng-content">
                            <div >
                            <h3 class="line">
                                
                            <span class="f24">传媒教师培训</span>
                            <img src="<?=Url::to('@web/mlv/img/index/jineng-02.png', true)?>" alt="">
                            </h3>
                            <p>专为传媒高校教师打造，最前沿的传媒行业技术与发展趋势、最新的教学实践环境、最新的授课案例，参加一次，就知道</p>
                            </div>
                            <div >
                            <h3 class="line">
                                
                            <span class="f24">电视台人员培训</span>
                            <img src="<?=Url::to('@web/mlv/img/index/jineng-03.png', true)?>" alt="">
                            </h3>
                                <p>电视台专业编辑人员快速掌握索贝产品功能特点及使用的不二途径，各项制作技巧一次get
</p>
                            </div>
                        </div>
                        <div class="r index-jineng-content">
                            <div >
                            <h3 class="line">
                                <img src="<?=Url::to('@web/mlv/img/index/jineng-04.png', true)?>" alt="">
                            <span class="f24">企业定制培训
</span>
                            </h3>
                            <p>想学点符合自己需要的东西？想改变一下传统培训模式？省钱、省事、高效，企业定制培训服务一次满足
 </div>
                            <div >
                            <h3 class="line">
                                <img src="<?=Url::to('@web/mlv/img/index/jineng-05.png', true)?>" alt="">
                            <span class="f24">厂商系统培训</span>
                            </h3>
                                <p>专全球独家国内广播电视系统龙头企业索贝数码和华栖云服务产品培训教程，想要就有，华栖云教独家发售
</div>
                        </div>
                        
                        
                        
                    </div>

                        
                    
                  

                </div>

            </div>
             <!-- 专业认证 -->
            <div class="swiper-slide " style="background-color:#f2f2f2">
                <div class="index-content clearfix">
                    <div class="index-swiper-top"> 
                        <h1 class="f36">[ 专业认证 ]</h1>
                        <p >联合中国电影电视技术学会与索贝数码，提供传媒从业人员专业技术水平的考核与认证

                  </p>
                         <a href="<?=Url::to("/site/certification")?>">了解详情＞</a>
                    </div>
                   
                     <div class=" clearfix">
                         <div class="index-swiper-bot index-rengzheng-bot l" >
                        <div >
                            <h3 >
                                <img src="<?=Url::to('@web/mlv/img/index/renzheng-03.png', true)?>" style="margin-right:20px;"alt="">
                            <span class="f24">生态底层更专业 </span>
                        </h3>
                            <p>基于超过18年的行业积累打造</p>
                        </div>
                        <div >
                            <h3 >
                                <img src="<?=Url::to('@web/mlv/img/index/renzheng-04.png', true)?>" style="margin-right:20px;"alt="">
                            <span class="f24">国家权威机构合作 </span>
                        </h3>
                            <p>中国电影电视技术学会联合颁发证书</p>
                        </div>
                        <div >
                            <h3 >
                                <img src="<?=Url::to('@web/mlv/img/index/renzheng-05.png', true)?>" style="margin-right:20px;"alt="">
                            <span class="f24">学习考试拿证一站式服务</span>
                        </h3>
                            <p>足不出户，就能轻松拿证</p>
                        </div>
                        
                        
                    </div>
                    <img src="<?=Url::to('@web/mlv/img/index/renzheng-01.png', true)?>" class="index-rengzhengP l" alt="专业认证" >
                    <img src="<?=Url::to('@web/mlv/img/index/renzheng-02.png', true)?>" alt="专业认证" class="l">
                     </div>

                        
                   
                  

                </div>

            </div>
            <a href="#"></a>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
     </div>
     <div class="index-footer" >
         成都华栖云科技有限公司&nbsp;<span >Copyright  2016, hqyunjiao.com, All Rights Reserved </span>
     </div>	
</div>

<style type="text/css">
	
	footer.footer{
		display: none;
	}
	.bread-crumbs{
		display: none;
	}
	html{
		width: 100%;
	}
	 body {
        background: #fff;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
        padding-top: 0!important;
        width: 100%;
        background-color: rgb(242, 242, 242);
    }
    header+div{
        z-index: 10000;
        position: relative;
    }
    .swiper-container {
        width: 100%;  
        cursor: auto!important;        
    }
    .swiper-slide {
        background-position: top center;
        background-size: auto;
        width: 100%;
        height: 800px;
    }
    header{
            position: inherit;
    }
    header,.header-search input{
       background-color: #2e313d;
    }
    .header-nav li.act a{
            color: #e76f45;
            background-color: #000;
    }
    .header-nav li a,.header-user-bt a{
        color: #c5c8d4;
    }
   
</style>
<script>
$(function(){
    
})
</script>