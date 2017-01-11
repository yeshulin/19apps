<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/16
 * Time: 18:02
 */
use yii\helpers\Url;
$this->registerJsFile('@web/mlv/js/get-data.js');
$this->registerJsFile('@web/mlv/js/yunjiao.fun.js');
?>

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
        <div class="am-sticky-placeholder" style="height: 41px; margin: 0px;"><nav class="scrollspy-nav" data-am-scrollspynav="{offsetTop: 45}" data-am-sticky="" style="margin: 0px;">
                <ul>
                    <li><a href="#about" class="am-active">课程简介</a></li>
                    <li><a href="#func" class="">课程目录</a></li>
                </ul>
            </nav></div>

        <div class="am-panel am-panel-default" id="about">
            <div class="am-panel-hd f18">课程简介</div>
            <div class="am-panel-bd">
                <?=$data['description']?>
            </div>
        </div>


        <div class="am-panel am-panel-default" id="func">
            <div class="am-panel-hd f18">课程目录</div>
            <div class="am-panel-bd">
                <script id="course-catalog-sections" type="text/x-jsrender">
                     <div class="task-chapter">
                        <h3 class="chapter-tt">{{:sections}}</h3>
                        <div class="task-part-list">
                            {{:BarsHtml}}
                        </div>
                    </div>
                </script>
                    <script id="course-catalog-bars" type="text/x-jsrender">
                    <div class="task-part-item">
                        <div class="task-part-hd"> <span class="tt-prefix">{{:barsNum}}</span>
                            <h3 class="part-tt">{{:bars}}</h3>
                        </div>
                        <div class="task-task-list">
                            {{:KnowsHtml}}
                        </div>
                    </div>
                </script>
                <script id="course-catalog-knows" type="text/x-jsrender">
                    <a class="task-task-item task-item-jump " href="{{:href}}" target="_blank">
                        <i class="icon-play-circle i-course-record item-icon"></i>
                        <p class="task-tt">
                            <span class="task-tt-text" title="{{:knows}}">{{:knows}}</span>
                            <span class="tt-suffix">({{:time}})</span>
                        </p>
                    </a>
                </script>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    @charset "UTF-8";

    .task-chapter .chapter-tt {
        line-height: 60px;
        border-bottom: 1px solid #e5e5e5;
        font-size: 18px;
    }

    .task-chapter+.task-chapter .chapter-tt {
        border-top: 1px solid #e5e5e5;
    }

    .task-chapter .task-task-list {
        margin-left: 20px;
        margin-right: 20px;
    }

    .task-part-list {
        padding-top: 30px;
        padding-bottom: 1px;
        margin-left: 20px;;
    }

    .task-part-item {
        margin-bottom: 20px;
    }

    .task-part-item .task-part-hd {
        height: 40px;
        line-height: 40px;
        height: 40px;
        background: #f3f3f3;
        position: relative;
        margin-bottom: 20px;
    }

    .task-part-item .part-tt {
        font-size: 16px;
        line-height: inherit;
    }

    .task-part-item .tt-prefix {
        background: #666;
        color: #fff;
        width: 72px;
        text-align: center;
        font-size: 18px;
        float: left;
        margin-right: 8px;
    }

    .task-part-item .flag-orange-bg {
        margin-left: 5px;
    }

    .task-task-list .task-task-item {
        position: relative;
        line-height: 40px;
        padding-left: 53px;
        display: block;
        width: 100%;
        color: #333;
        box-sizing: border-box;
    }

    .task-task-list .task-task-item .task-tt-expr {
        color: #188eee;
    }

    .task-task-list .task-task-item .item-icon {
        position: absolute;
        left: 0;
        top: 50%;
        width: 53px;
        text-align: center;
        font-size: 24px;
        color: #a3d2f8;
        margin-top: -12px;
    }

    .task-task-list .task-task-item .task-tt-text {
        display: inline-block;
        vertical-align: middle;
    }

    .task-task-list .task-task-item .tt-suffix {
        color: #999;
        margin-left: 10px;
        display: inline-block;
        vertical-align: middle;
    }

    .task-task-list .task-task-item .icon-playback {
        position: relative;
        color: #999;
        border: 1px solid;
        border-radius: 2px;
        margin-left: 10px;
        height: 14px;
        width: 16px;
        display: inline-block;
        vertical-align: middle;
    }

    .task-task-list .task-task-item .icon-playback:before {
        position: absolute;
        left: 6px;
        top: 2px;
        border-left: 5px solid #999;
        border-top: 5px dashed transparent;
        border-bottom: 5px dashed transparent;
    }

    .task-task-list .task-task-item .btn-s {
        right: 10px;
        margin-top: -15px;
    }

    .task-task-list .task-task-item .item-progress {
        display: inline-block;
        vertical-align: middle;
        margin-left: 15px;
        width: 50px;
        background: #ccc;
        height: 4px;
    }

    .task-task-list .task-task-item .item-progress .percent {
        display: block;
        height: 4px;
        background: #5fb41b;
    }

    .task-task-list .task-task-item .hover-guide {
        display: none;
        color: #039ae3;
    }

    .task-task-list .task-task-item .hover-guide .i-v-right {
        font-size: 22px;
        vertical-align: -1px;
    }

    .task-task-list .task-task-item .i-right {
        font-size: 24px;
        color: #5fb41b;
        vertical-align: -3px;
        margin-left: 10px;
    }

    .task-task-list .task-task-item.task-task-item--done .item-icon {
        color: #999;
    }

    .task-task-list .task-task-item.task-task-item--disabled .item-icon,.task-task-list .task-task-item.task-task-item--disabled .task-tt {
        color: #999;
    }

    .task-task-list a.task-task-item.task-item-jump:hover {
        background-color: #daedfd;
    }

    .task-task-list a.task-task-item.task-item-jump:hover .item-icon {
        color: #039ae3;
    }

    .task-task-list a.task-task-item.task-item-jump:hover .hover-guide {
        display: inline-block;
    }

    .task-task-list a.task-task-item.task-item-jump:hover .hover-guide~.item-num-percent,.task-task-list a.task-task-item.task-item-jump:hover .hover-guide~.item-progress,.task-task-list a.task-task-item.task-item-jump:hover .hover-guide~.i-right,.task-task-list a.task-task-item.task-item-jump:hover .hover-guide~.item-score {
        display: none;
    }

    .task-task-list a.task-item-nojump {
        cursor: default;
    }
    .task-task-list .task-task-item .icon-playback:before {
        content: "";
        height: 0;
        width: 0;
        overflow: hidden;
    }
    .task-task-list .task-task-item .task-tt-text,.course-class--three .class-tt-list .item-name,.mod-choose-time_v2 .mod-choose-time__time,.tips-buy-course .mod-course-banner__title,.teacher-list .teacher-item .text-tt,.course-class-task .drop-down--class .drop-down-tt,.aside-recommend h4,.section--course-package .course-package .package-list-item .course-info-title,.section--course-package .course-package .package-list-item .course-info-class,.package-dialog .package-list-item .course-info-title,.package-dialog .package-list-item .course-info-class,.section--relation .recommend-course-tit,.section--relation .recommend-benefit-des {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        word-wrap: normal;
    }
    .task-task-list .task-task-item .icon-playback:before {
        content: "";
        height: 0;
        width: 0;
        overflow: hidden;
    }
</style>

<?php //var_dump($data)?>
<script type="text/javascript">
$(function() {

    var getDataObj = new getData();

    $.get('<?= Url::to(['/api/course-info', 'id'=>$data['association_id']])?>', function (result) {
        var _data = result.data, htmlOutput = '';
//        console.log(_data);
        if (_data.length != 0) {
            var u_data = $.map(_data, function (n, k) {
//                console.log(n);
                k ++;
                var _BarsHtml = $.map(n.CourseBars, function (bars, kb) {
                    kb ++;
                    var  _KnowsHtml = $.map(bars.CourseKnows, function (knows) {
                        var time = '1000';
                        if (knows.time !== undefined)
                        {
                            time = knows.time;
                        }
                        return {
                            knows: knows.name,
                            time: duration(time, 's'),
                            href: '<?= Url::to(['/site/course/play', 'id'=>''])?>'+ knows.knowsid
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
                    sections: '第'+numberToChinese(k)+'章 '+n.name,
                    BarsHtml: BarsHtml
                };
            });
//            console.log(u_data);
            var template = $.templates("#course-catalog-sections");
            htmlOutput = template.render(u_data);
//            console.log(htmlOutput);
        }
        $("#course-catalog-knows").after(htmlOutput);
    })
})
</script>
