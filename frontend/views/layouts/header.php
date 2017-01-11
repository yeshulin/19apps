<?php
    use yii\helpers\Url;
    ?>
    <?php
    $this->registerJsFile('@web/mlv/js/jquery-1.9.1.min.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/mlv/js/sobeyPlug-in.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/mlv/js/jsrender.min.js',['position'=>\yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/mlv/js/member-common.js',['position'=>\yii\web\View::POS_HEAD]);
    if (!(
        Yii::$app->controller->id == 'site' &&
        Yii::$app->controller->action->id == 'index'
    )) {


        $this->registerJsFile('@web/mlv/js/amazeui.min.js');
        $this->registerJsFile('@web/mlv/js/header.js');

    } else {
        $this->registerJsFile('@web/mlv/js/header-index.js');
        $this->registerJsFile('@web/mlv/js/jquery.mousewheel.js');
        

    }
//    $this->registerJsFile('@web/mlv/js/header.js');
	

	  
	$this->registerCssFile('@web/mlv/js/cropper-master/assets/css/bootstrap.min.css');
    $this->registerCssFile('@web/mlv/css/amazeui.min.css');
    $this->registerCssFile('@web/mlv/css/head.css');
    $this->registerCssFile('@web/mlv/css/css.css');
    $this->registerCssFile('@web/mlv/css/font-awesome.min.css');
    $this->registerCssFile('@web/mlv/css/hqy2016.css');
    ?>
    <script>
        var userInfo = <?php echo Yii::$app->user->identity?json_encode(\common\helpers\String::arrayFilterMember(Yii::$app->user->identity->toArray())):"null"?>;
        var urlPre = "<?=Url::to('@web/', true)?>";
        function serach(o){
            var  _value = $(o).siblings("input").val();
            if (_value != "")
            {
                window.location.href = "<?= Url::to(['/site/course/list', 'courseName'=>''])?>"+_value;
            }
        }
    </script>
    <div class="clearfix" id="header-box" style="position: relative;">
        
    </div>
    <script id="headerTmpl" type="text/x-jsrender">
    <section class="hqy2016 p15"><a target="_blank" href="/our2016.html">
        <img src="<?=Url::to('@web/mlv/img/hqy2016/hqy2016.png', true)?>" alt="" style="position: absolute;vertical-align: top;left: 0;top: 0;">
                <div class="t1" style="left: -42px;">
                    <div class="in"></div>
                </div>
                <div class="t1 t2" style="right: -50px;">
                    <div class="in"></div>
                </div>
    </a></section>
<div class="header-logo">
            <a href="/">
                <img src="<?=Url::to('@web/mlv/img/head/logo.png', true)?>" alt=""/>                
            </a>
        </div>
        <ul class="header-nav">
            <li>
                <a href="<?= Url::to(['/site/course']) ?>">
                    在线学习
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['/site/live']) ?>">
                    教育直播
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['/site/lab']) ?>">
                    云端实验室
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['/site/practical']) ?>">
                    企业实训
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['/site/train']) ?>">
                    技能培训
                </a>
            </li>
            <li>
                <a href="<?= Url::to(['/site/certification']) ?>">
                    专业认证
                </a>
            </li>
            <div></div>
        </ul>
        <div class="header-user">
            <div class="header-user-bt">
                <a style="display: none;" href="#">高校圈子</a>
                <a style="display: none;" href="#">关于我们</a>
                {{if logined}}
                    <a href="<?= Url::to(['/user'])?>">
                    {{if nickname}}
                        {{:nickname}}
                    {{else}}
                        {{:name}}
                    {{/if}}
                     </a>
                     <a href="javascript:void(0);" id="user-logout" style="margin-left: 10px;">退出</a>
                    {{else}}
                     <a href="<?= Url::to(['/auth/login']) ?>">登录</a>
                    <a href="<?= Url::to(['/auth/reg']) ?>" style="margin-left: 10px;">注册</a>
                {{/if}}
               
            </div>
            <div class="header-search">
                <input type="text" placeholder="输入搜索"/>
                    <span onclick="serach(this)">
                        <i class="icon-search"></i>
                    </span>
                <div style="display: none;">
                    <a href="javascript:void(0);">花字制作</a>
                    <a href="javascript:void(0);">大数据</a>
                </div>
            </div>
        </div>
</script>
