<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = '视频播放';
?>
<?php
$this->registerJsFile('@web/mlv/js/jquery.slimscroll.min.js');
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerJsFile('@web/mlv/js/yunjiao.fun.js');
?>
<style>
    body{
        background-color: #1a1e2b;
    }
    .pc-video-box{
        width: 1200px;
        margin: auto;
        padding-bottom: 80px;
    }

    .pc-video-v{

        height: 495px;
    }
    .pc-video-v .l{
        width: 880px;
    }
    .pc-video-v .r {
        width: 320px;
        background-color: #10121a;
        height: 495px;
    }
    #video object{
    	position: relative!important;
    	width: 880px!important;
    	height: 495px!important;
    }
    
    .menue-style1{
    	
    }
    .menue-style1 .menue-style1-item1{
    	
    }
    .menue-style1 .menue-style1-item1 > h2{
    	font-size: 16px;
    	color: #989aa7;
    	font-weight: normal;
    	line-height: 24px;
    	
    }
    .menue-style1 span{
    	cursor: pointer;
    }
    .menue-style1 .menue-style1-item2 > h2{
    	font-size: 14px;
    	color: #989aa7;
    	font-weight: normal;
    	padding-left: 30px;
    	line-height: 24px;
    	
    }
    .menue-style1 .menue-style1-item3 > p{
    	font-size: 14px;
    	color: #5d5f6a;
    	font-weight: normal;
    	padding-left: 60px;
    	line-height: 24px;
    	
    }
    .menue-style1 .menue-style1-item3 > p > span:hover{
    	color: #e76f45;
    }
       .pc-video-v .r .am-tabs-default .am-tabs-nav{
    	background: none;
   		border-bottom: 1px solid #343847;
   		height: 49px;
    }
       .pc-video-v .r .am-tabs-default .am-tabs-nav a{
    	    color: #727687;
    line-height: 47px;
    font-size: 16px;
    border-bottom: 2px solid transparent;
    }
       .pc-video-v .r .am-tabs-default .am-tabs-nav>.am-active a{
    	    color: #727687;
    background: none;
    border-color: #e76f45;
    }
    .pc-video-v .r .am-tab-panel{
    	    height: 435px;
    }   
</style>
 <div class="bread-crumbs">
            <div>
                <a href="#">首页</a>
                <span>&nbsp;&gt;&nbsp;</span>
                <span>个人中心</span>
            </div>
</div>
<div class="pc-video-box">
    <div class="pc-video-v clearfix">
        <div class="l" id="video">

        </div>
        <div class="r">
        	<div data-am-widget="tabs" class="am-tabs am-tabs-default" data-am-tabs-noswipe="1">
      <ul class="am-tabs-nav am-cf">
          <li class="am-active"><a href="[data-tab-panel-0]">互动交流</a></li>
          <li class=""><a href="[data-tab-panel-1]">课程目录</a></li>          
      </ul>
      <div class="am-tabs-bd">
          <div data-tab-panel-0 class="am-tab-panel am-active">
            <iframe scrolling="no" src="http://chat.hqyunjiao.com:55151?room_id=1<?=$id?>&userid=<?=$user['id']?>&username=<?=$user['username']?>&uimg=<?=$user['headimg']?>" width="280" height="420" frameborder="0"></iframe>
          </div>
          <div data-tab-panel-1 class="am-tab-panel am-tab-panel2">
            <div class="menue-style1">
            	<div id="catalog-course">
                    <script id="course-catalog-sections" type="text/x-jsrender">
                        <div class="menue-style1-item1">
                            <h2><span>{{:sectionsNum}}：{{:sections}}</span></h2>
                            {{:BarsHtml}}
                        </div>
                    </script>
                    <script id="course-catalog-bars" type="text/x-jsrender">
                        <div class="menue-style1-item2">
                            <h2><span>{{:barsNum}}：{{:bars}}</span></h2>
                            <div class="menue-style1-item3">
                                {{:KnowsHtml}}
                            </div>
                        </div>
                    </script>
                    <script id="course-catalog-knows" type="text/x-jsrender">
                            <p><span style="{{:style}}" onclick="CoursePlay({{:knowsid}}, this)" time="{{:time}}">{{:knowsNum}}：{{:knows}}</span></p>
                    </script>
            	</div>
            </div>
          </div>
      </div>
  </div>
        	
        </div>
    </div>
</div>
<script type="text/javascript">
    function CoursePlay (knowsid, event) {
        var getDataObj = new getData();
//        console.log(2);
        getDataObj.getCoursePlay(knowsid,function(result){
//            console.log(result);
            if (result.code == '0000')
            {
                if (event != undefined)
                {
                    $(".menue-style1-item3").find("span").removeAttr("style");
                    event.style.color="#e76f45";
                }
                $("#video").html(result.data.play);
            } else {
                sobeyAlert(result.error, function() {
                    window.location.href = "<?= Url::to(['/site/course'])?>";
                });
            }
        });
    }
$(function(){

    CoursePlay(<?= $id?>);
    $.get('<?= Url::to(['/api/course-info', 'idType'=>'knows', 'id'=>$id])?>', function (result) {
        var _data = result.data, htmlOutput = '';
//        console.log(_data);
        if (_data.length != 0) {
            var u_data = $.map(_data, function (n, k) {
//                console.log(n);
                k ++;
                var _BarsHtml = $.map(n.CourseBars, function (bars, kb) {
                    kb ++;
                    var  _KnowsHtml = $.map(bars.CourseKnows, function (knows, kk) {
                        kk ++;
                        var time = '1000';
                        if (knows.time !== undefined)
                        {
                            time = knows.time;
                        }
                        return {
                            knows: knows.name,
                            time: duration(time, 's'),
                            knowsNum: kk,
                            knowsid: knows.knowsid,
                            style: (knows.knowsid == <?= $id?>)?"color:#e76f45":""
                        };
                    });
                    var template = $.templates("#course-catalog-knows");
                    KnowsHtml = template.render(_KnowsHtml);
                    return {
                        bars: bars.name,
                        barsNum:'第'+numberToChinese(kb)+'节 ',
                        KnowsHtml: KnowsHtml
                    };
                });
                var template = $.templates("#course-catalog-bars");
                BarsHtml = template.render(_BarsHtml);
                return {
                    sectionsNum: '第'+numberToChinese(k)+'章 ',
                    sections: n.name,
                    BarsHtml: BarsHtml
                };
            });
//            console.log(u_data);
            var template = $.templates("#course-catalog-sections");
            htmlOutput = template.render(u_data);
//            console.log(htmlOutput);
        }
        $("#course-catalog-knows").after(htmlOutput);
    });
    
    $('.menue-style1 > div').slimScroll({
        color: '#414758',
    size: '3px',
        height: '415px'
    });
});

</script>