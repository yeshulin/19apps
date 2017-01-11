<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/15
 * Time: 10:30
 */
$this->registerJsFile('@web/mlv/js/idangerous.swiper.min.js');
$this->registerCssFile('@web/mlv/css/idangerous.swiper.css');
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
 
$this->title = '专业认证';
use yii\helpers\Url;


?>
<style>
	body{
		background-color: #f2f2f2;
	}
    header{
        background-color: #fff;
    }
</style>
<div style="height: 550px;background: url(<?=Url::to('@web/mlv/img/banner9.jpg', true)?>) no-repeat top center"></div>
<div  style="margin-top: 50px;">
    <div class="inner">
        <h2 class="title-stl1">
            <p></p>
            <span>职业认证项目</span>

        </h2>
        <script id="practical-list" type="text/x-jsrender">
            <div class="textimg3 {{:style}} clearfix" style="margin-top: 20px;">
                <a target="_blank" href="{{:url}}">了解详情</a>
                <img src="{{:thumb}}" alt=""/>
                <div>
                    <h4><a href="{{:url}}" target="_blank">{{:name}}</a></h4>
                    <div style="height:200px">
                    <p><span>认证简介:</span> {{:brief}}
                        <br><span>适用对象:</span> {{:object}}</p>
                    </div>
                </div>
            </div>
        </script>

<!--        <div class="textimg3 textimg3-img-text clearfix" style="margin-top: 20px;">-->
<!--            <a href="#">了解详情</a>-->
<!--            <img src="img/temmpp.jpg" alt=""/>-->
<!--            <div>-->
<!--                <h4><a href="#">索贝中级视频工程师认证</a></h4>-->
<!--                <p><span>认证简介:</span> 索贝中级视频工程师认证是面向具有一定剪辑基础的传媒类专业学生和初入职场的视频编辑制作人员推出的视频制作能力的认证。获得此项认证，表明学员能够利用专业非编软件完成视频的剪辑、特效编辑、色彩校正、字幕编辑、音频编辑等视频制作，掌握视频制作的基本方法和技能，能够胜任一般节目制作工作。-->
<!--                    <br><span>适用对象:</span> 具有一定剪辑基础的传媒类专业学生、初入职场的视频编辑制作人员。</p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="textimg3 textimg3-text-img clearfix" style="margin-top: 20px;">-->
<!--            <a href="#">了解详情</a>-->
<!--            <img src="img/temmpp2.jpg" alt=""/>-->
<!--            <div>-->
<!--                <h4><a href="#">索贝中级视频工程师认证</a></h4>-->
<!--                <p><span>认证简介:</span> 索贝中级视频工程师认证是面向具有一定剪辑基础的传媒类专业学生和初入职场的视频编辑制作人员推出的视频制作能力的认证。获得此项认证，表明学员能够利用专业非编软件完成视频的剪辑、特效编辑、色彩校正、字幕编辑、音频编辑等视频制作，掌握视频制作的基本方法和技能，能够胜任一般节目制作工作。-->
<!--                    <br><span>适用对象:</span> 具有一定剪辑基础的传媒类专业学生、初入职场的视频编辑制作人员。</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="textimg3 textimg3-img-text clearfix" style="margin-top: 20px;">-->
<!--            <a href="#">了解详情</a>-->
<!--            <img src="img/temmpp3.jpg" alt=""/>-->
<!--            <div>-->
<!--                <h4><a href="#">索贝中级视频工程师认证</a></h4>-->
<!--                <p><span>认证简介:</span> 索贝中级视频工程师认证是面向具有一定剪辑基础的传媒类专业学生和初入职场的视频编辑制作人员推出的视频制作能力的认证。获得此项认证，表明学员能够利用专业非编软件完成视频的剪辑、特效编辑、色彩校正、字幕编辑、音频编辑等视频制作，掌握视频制作的基本方法和技能，能够胜任一般节目制作工作。-->
<!--                    <br><span>适用对象:</span> 具有一定剪辑基础的传媒类专业学生、初入职场的视频编辑制作人员。</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="textimg3 textimg3-text-img clearfix" style="margin-top: 20px;">-->
<!--            <a href="#">了解详情</a>-->
<!--            <img src="img/temmpp4.jpg" alt=""/>-->
<!--            <div>-->
<!--                <h4><a href="#">索贝中级视频工程师认证</a></h4>-->
<!--                <p><span>认证简介:</span> 索贝中级视频工程师认证是面向具有一定剪辑基础的传媒类专业学生和初入职场的视频编辑制作人员推出的视频制作能力的认证。获得此项认证，表明学员能够利用专业非编软件完成视频的剪辑、特效编辑、色彩校正、字幕编辑、音频编辑等视频制作，掌握视频制作的基本方法和技能，能够胜任一般节目制作工作。-->
<!--                    <br><span>适用对象:</span> 具有一定剪辑基础的传媒类专业学生、初入职场的视频编辑制作人员。</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>

    <script type="text/javascript">
        $(function(){
            var getDataObj = new getData();

            getDataObj.getGoodsList('certification',20,1,function(result){
                var _data = result.data.data;
                if (_data.length != 0) {
                    var i=0;
                    var u_data = $.map(_data,function(n){
                        i++;
                        return {
                            style:(i%2==0 ? 'textimg3-text-img' : 'textimg3-img-text'),
                            name:n.goods_name,
                            thumb: n.goods_thumb,
                            url: '<?=Url::to(['/site/goods'])?>?id='+n.goods_id,
                            brief: n.certification.brief.replace(/<[^>]+>/g,""),
                            object: n.certification.object
                        };
                    });
                    var template = $.templates("#practical-list");
                    var htmlOutput = template.render(u_data);
                    $("#practical-list").after(htmlOutput);
                }
            });
        })
    </script>
</div>
<div>
    <div class="rzcontent2" style="margin-top: 35px;">
        <h2 style="padding-top: 70px;">权威认证，国家认可，全国范围有效！</h2>
        <p style="margin-top: 240px;">报考索贝视频工程师认证的考生不受国籍、年龄、职业、学历及户口所在地等限制，</p>
        <p>社会各界人士均可根据自身学习和工作的实际需要，选择不同的科目进行学习、接受培训、参加考试。</p>
    </div>
    <div class="rzcontent3">
        <div>
            <h2>3步轻松拿证</h2>
            <div style="margin-top: 52px;">
                <div class="content3_step content3_step_act" tag="0" style="margin-left:3px;">
                    <div class="content3_step1"></div>
                    <p>报名</p>
                </div>
                <div class="content3_step" tag="1">
                    <div class="content3_step2"></div>
                    <p>学习</p>
                </div>
                <div class="content3_step" tag="2">
                    <div class="content3_step3"></div>
                    <p>考试</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="content3_alert" tag="0" style="margin-top: 36px;display: block;">
                <div class="content3_alert_arrow" style="top: -12px;left: 34px;"></div>
                <p class="color-style2 f14 line-height22" style="padding-left: 59px;padding-top: 32px;">选择要报考的证书，在线支付即可完成报名<br>
                    如果你还想了解更多有关证书的相关情况，请 <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1665529834&amp;site=学院客服&amp;menu=yes" class="color-ff6e00">咨询学习顾问&gt;&gt;</a>
                </p>
            </div>
            <div class="content3_alert" tag="1" style="margin-top: 36px;">
                <div class="content3_alert_arrow" style="top: -12px;left: 361px;">

                </div>
                <p class="color-style2 f14 line-height22" style="padding-left: 59px;padding-top: 32px;">根据相关认证推荐的学习方式，进行线上学习、教材学习或者线下培训<br>
                    如果你还想了解更多有关证书的相关情况，请 <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1665529834&amp;site=学院客服&amp;menu=yes" class="color-ff6e00">咨询学习顾问&gt;&gt;</a>
                </p>
            </div>
            <div class="content3_alert" tag="2" style="margin-top: 36px;">
                <div class="content3_alert_arrow" style="top: -12px;left: 690px;">

                </div>
                <p class="color-style2 f14 line-height22" style="padding-left: 59px;padding-top: 32px;">根据不同的认证，参加线上考试或是线下考核，合格通过后即可获得相关证书<br>
                    如果你还想了解更多有关证书的相关情况，请 <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1665529834&amp;site=学院客服&amp;menu=yes" class="color-ff6e00">咨询学习顾问&gt;&gt;</a>
                </p>
            </div>
        </div>

    </div>
    <div class="rzcontent4">
        <div>
            <h3>常见问题</h3>
            <div style="margin-top: 70px;">
                <div class="l" style="width: 440px;margin-left: 83px;">
                    <h4 class="f16 color-style2">证书是哪里颁发的？怎么确定真伪？</h4>
                    <p class="f12 color-626262 line-height22" style="margin-top: 22px;">索贝学院职业认证均有中国电影电视技术学会与索贝学院联合颁发，每个证书具有唯一的证书编号，凭证书编码可查询证书真伪。</p>
                </div>
                <div class="r" style="width: 440px;margin-right: 56px;">
                    <h4 class="f16 color-style2">证书有几种形式？如何发放？</h4>
                    <p class="f12 color-626262 line-height22" style="margin-top: 22px;">索贝学院职业证书分为纸质证书和电子证书两种形式，电子证书可以直接在索贝学院网站上进行下载。</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div style="margin-top: 106px;">
                <div class="l" style="width: 440px;margin-left: 83px;">
                    <h4 class="f16 color-style2">证书是否有时效性限制？</h4>
                    <p class="f12 color-626262 line-height22" style="margin-top: 22px;">索贝学院职业证书没有时效性限制，学员一经考试获得，终生有效。</p>
                </div>
                <div class="r" style="width: 440px;margin-right: 56px;">
                    <h4 class="f16 color-style2">不参加考试能否获得证书？未通过考试怎么办？</h4>
                    <p class="f12 color-626262 line-height22" style="margin-top: 22px;">要获得索贝学院职业证书，必须通过相应的考试，未通过考试者，可以有一次免费的补考机会。</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div>
        <div class="rzactive">
            <div class="rza1">
                <div class="rzati">学员动态</div>
                <!--device-->
                <div class="device">
                    <a class="arrow-left" href="#"></a>
                    <a class="arrow-right" href="#"></a>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>

                            <!--swiper-->
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            hhxy                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            LICKYO                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            fair                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="swlist">
                                    <div class="sw1"><span class="swname">
                            <!-- <a href="http://www.yiqibian.com/index.php?m=member&c=otherzone&a=init&id=10262">我的</a> -->
                            yoyo                            </span><span class="swtime">通过了</span></div>
                                    <div class="sw2">

                                        <!-- <img  src="http://www.sobeycollege.com/phpsso_server/uploadfile/avatar/5/2/41311/200x200.jpg"> -->

                                        <img  src="/mlv/img/member/nophoto.gif">

                                    </div>
                                    <div class="sw3">

                                        索贝视频工程师教师认证

                                    </div>
                                </div>
                            </div>


                        </div>
                        </div>
                    </div>
                </div>
            </div>

                        </div>
  
    <style>
        .device {
            width: 1200px;
            height: 150px;
            margin: 5px auto;
            position: relative;
            margin-top:40px;
        }
        .device .arrow-left {
            background: url(<?=Url::to('@web/mlv/img/al.png', true)?>) no-repeat left top;
            position: absolute;
            left: 10px;
            top: 40%;
            margin-top: -15px;
            width: 23px;
            height: 45px;
        }
        .device a:hover.arrow-left {
            background: url(<?=Url::to('@web/mlv/img/al_1.png', true)?>) no-repeat left top;
            position: absolute;
            left: 10px;
            top: 40%;
            margin-top: -15px;
            width: 23px;
            height: 45px;
        }
        .device .arrow-right {
            background: url(<?=Url::to('@web/mlv/img/ar.png', true)?>) no-repeat left bottom;
            position: absolute;
            right: 10px;
            top: 40%;
            margin-top: -15px;
            width: 23px;
            height: 45px;
        }
        .device a:hover.arrow-right {
            background: url(<?=Url::to('@web/mlv/img/ar_1.png', true)?>) no-repeat left bottom;
            position: absolute;
            right: 10px;
            top: 40%;
            margin-top: -15px;
            width: 23px;
            height: 45px;
        }
        .swiper-container {
            height: 150px;
            width: 1050px;
        }
        .content-slide {
            width:1050px;
            height:150px;
            text-align:center;
        }
        .swlist {width:120px; height:150px; text-align:center; float:left; margin-right:25px; margin-left:25px;}
        .sw1{text-align:center;width:120px;}
        .swname a{font-size:12px; color:#0068b7; font-family:"微软雅黑";}
        .swname a:hover{font-size:12px; color:#00a0e9; font-family:"微软雅黑";}
        .swtime{font-size:12px; color:#535353; font-family:"微软雅黑"; padding-left:5px;}
        .sw2 {text-align:center;width:120px; margin-top:10px; margin-bottom:10px;}
        .sw2 img{
            width:90px;
            height:90px;
            border-radius:100%;
            margin-bottom:5px;
        }
        .sw3 a{color:#808080;font-size:12px;font-family:"微软雅黑"; }
        .sw3 a:hover{color:#ff6e00;font-size:12px;font-family:"微软雅黑"; }



        .rzcss{

        }
    </style>

</div>

<script>
    $(function(){
        $(window).scroll(function(){
            if($(window).scrollTop() == 0){
                $(".sobey_right_fixed_dingbu").css("visibility","hidden");
            }else{
                $(".sobey_right_fixed_dingbu").css("visibility","visible");
            }
        })
        $(".sobey_right_fixed > div > a").hover(function(){
            var objThis = $(this);
            if(!objThis.hasClass("sobey_right_fixed_not")){
                objThis.stop().animate({"width":"138px"},300);
            }

        },function(){
            var objThis = $(this);
            if(!objThis.hasClass("sobey_right_fixed_not")){
                objThis.stop().animate({"width":"50px"},300);
            }
        });
        $(".sobey_right_fixed_weixin").hover(function(){
            $(".sobey_right_fixed_weixin_img").stop().fadeIn(300);
        },function(){
            $(".sobey_right_fixed_weixin_img").stop().fadeOut(300);
        });
        $(".sobey_right_fixed_android").hover(function(){
            $(".sobey_right_fixed_android_img").stop().fadeIn(300);
        },function(){
            $(".sobey_right_fixed_android_img").stop().fadeOut(300);
        });
        var page_box_width = 0;
        $(".pages").children("span,a").each(function(){
            var that =$(this);
            page_box_width += (that.width()+10);
        });
        $(".pages").width(page_box_width+"px");
        $(".pages").css("margin-top","30px");



          var mySwiper = new Swiper('.swiper-container',{
            slidesPerView: 6,
            loop: true,
            autoplay:5000
        });
        $('.arrow-left').on('click', function(e){
            e.preventDefault();
            mySwiper.swipePrev();
        })
        $('.arrow-right').on('click', function(e){
            e.preventDefault();
            mySwiper.swipeNext();
        })

        $(".content3_step").on("mouseover",function(){
            var objThis = $(this);
            $(".content3_step").removeClass("content3_step_act");
            objThis.addClass("content3_step_act");
            $(".content3_alert").hide();
            $(".content3_alert[tag='"+ objThis.attr("tag") +"']").show();
        });
    });
</script>
