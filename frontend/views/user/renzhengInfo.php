<?php
use yii\helpers\Json;

?>
<?php
$this->registerJsFile('@web/mlv/js/amazeui.min.js');
$this->registerJsFile('@web/mlv/js/jsviews.min.js');
$this->registerJsFile('@web/mlv/js/Area.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/AreaData_min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/mlv/js/member-common.js');
$this->registerCssFile('@web/mlv/css/amazeui.min.css');
$this->registerCssFile('@web/mlv/css/member.css');
?>
<style>
    .renzheng-div {
        border: 1px solid black;
        font-size: 14px;
    }

    .renzheng-inner {
        padding-top: 5px;
        padding-left: 50px;
    }

    .control-table {
        width: 800px;
        border-top: 1px solid black;
        border-left: 1px solid black;
    }

    .control-groups span {
        display: table-cell;
        width: 200px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-bottom: 1px solid #333;
        border-right: 1px solid #333;
        color: #333;
    }

    .info {
        margin: 50px 0;
    }
    .control-header{
        margin-bottom:50px;
    }
    .hr{
        border-bottom:1px solid black;
    }
    /*.form-list{*/
    /*width:500px;*/
    /*border:1px solid red;*/
    /*text-align:center;*/
    /*margin-top:100px;*/
    /*}*/
    /*.control-group{*/
    /*margin:15px 0;*/
    /*}*/
</style>
<div class="renzheng-div">
    <div class="renzheng-inner">
        <script id="form-list" type="text/x-jsrender">
            <div>
                <div class="control-header">
                    <p>
                        <span>我的当前的认证等级：</span><span style="color:#FF0000;">{{:level}}</span>
                    </p>
                    <div class="hr"></div>
                </div>
                <div class="control-table">
                    <div class="control-groups">
                        <span>权限</span>
                        <span>普通用户</span>
                        <span>实名认证用户</span>
                        <span>企业/教育用户</span>
                    </div>
                    <div class="control-groups">
                        <span>学习免费课程</span>
                        <span>✔</span>
                        <span>✔</span>
                        <span>✔</span>
                    </div>
                    <div class="control-groups">
                        <span>购买付费课程</span>
                        <span>✔</span>
                        <span>✔</span>
                        <span>✔</span>
                    </div>
                    <div class="control-groups">
                        <span>报名认证考试</span>
                        <span>✔</span>
                        <span>✔</span>
                        <span>✔</span>
                    </div>
                    <div class="control-groups">
                        <span>购买直播服务</span>
                        <span></span>
                        <span>✔</span>
                        <span>✔</span>
                    </div>
                    <div class="control-groups">
                        <span>购买企业实训</span>
                        <span></span>
                        <span></span>
                        <span>✔(仅企业)</span>
                    </div>
                    <div class="control-groups">
                        <span>购买实验室</span>
                        <span></span>
                        <span></span>
                        <span>✔(仅教育)</span>
                    </div>
                </div>
                <div class="info" id="info" style="visibility: visible;">
                    <p>
                <span>
                普通用户：完成手机或邮箱验证注册，即可成为普通用户。
                </span>
                    </p>

                    <p><span><br></span></p>

                    <p>
                <span>
                实名认证用户：实名认证用户需提供身份证号、身份证照片、本人与身份证合照等相关材料。
                </span>
                        <span id="renzheng-person" ><a target="_blank"
                                href="{{:renzhengPerson}}" style=" text-decoration:none;color:#0000FF;">立即认证</a></span>
                    </p>

                    <p>
                        <span style="text-decoration:underline;color:#0000FF;"><br></span></p>

                    <p><span style="color:#000000;">机构用户认证：机构用户认证</span><span>需提供认证人身份证号、身份证照片、认证人与身份证合照、企业营业执照或教育行业相关资质证书等相关材料。</span>
                        <span id="renzheng-organ"
                              style="text-decoration:none;color:#0000FF;cursor:pointer">立即认证</span>
                    </p>
                </div>
            </div>

        </script>
        <div id="form-list-content" class="form-list tab-switch personal-wrap-show">
        </div>
    </div>
</div>
<script>
    var level = "<?=$level?>";
    $(function () {
        var data = {
            level: level,
            renzhengPerson: "<?=\yii\helpers\Url::to(['//user/info/renzheng?type=1'])?>"
        };
        var template = $.templates("#form-list");
        var htmlOutput = template.render(data);
        $("#form-list-content").html(htmlOutput);
        $("body").on("click", "#renzheng-organ", function () {
            var html = '<a target="_blank" href="<?=\yii\helpers\Url::to(['//user/info/renzheng?type=2'])?>">企业用户</a>';
            html += '&nbsp;&nbsp;';
            html += '<a target="_blank" href="<?=\yii\helpers\Url::to(['//user/info/renzheng?type=3'])?>">教育用户</a>';
            $("#renzheng-organ").html(html);
        });
    });
</script>
