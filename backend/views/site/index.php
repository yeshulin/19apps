<?php

/* @var $this yii\web\View */
use backend\models\Menu;
use backend\assets\MainAsset;

$this->title = '19apps-微信小程序解决系统';
MainAsset::register($this);
?>

<body class="fixed-sidebar full-height-layout gray-bg">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span style="    font-size: 37px;">欢迎你！</span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold"><?= Yii::$app->user->identity->username?></strong></span>
                                <span class="text-muted text-xs block">超级管理员<b class="caret"></b></span>
                                </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><?= \yii\helpers\Html::a('安全退出',['site/logout'])?>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
                <?php

               /* $menuItems = [
                    ['label' => 'Home', 'url' => ['site/index']],
                    // 'Products' menu item will be selected as long as the route is 'product/index'
                    ['label' => '系统设置', 'url' => '', 'items' => [
                        ['label' => '菜单管理', 'url' => ['menu/index']],
                        ['label' => '权限管理', 'url' => ['permission/index']],
                    ]],
                    ['label' => '会员管理', 'url' => '', 'items' => [
                        ['label' => '会员列表', 'url' => ['user/index']],
                        ['label' => '角色管理', 'url' => ['role/index'], 'items' => [
                            ['label' => '会员列表', 'url' => ['user/index']],
                            ['label' => '角色管理', 'url' => ['role/index'], 'items' => [
                                ['label' => '会员列表', 'url' => ['user/index']],
                                ['label' => '角色管理', 'url' => ['role/index'], 'items' => [
                                    ['label' => '会员列表', 'url' => ['user/index']],
                                    ['label' => '角色管理', 'url' => ['role/index'], 'items' => [
                                        ['label' => '会员列表', 'url' => ['user/index']],
                                        ['label' => '角色管理', 'url' => ['role/index'], 'items' => [
                                            ['label' => '会员列表', 'url' => ['user/index']],
                                            ['label' => '角色管理', 'url' => ['role/index']],
                                        ]],
                                    ]],
                                ]],
                            ]],
                        ]],
                    ]],
                ];*/
                //                    'items' => Menu::getMenuByUserid(Yii::$app->user->id),

                echo \backend\widgets\Menu::widget([
                    'items' => Menu::getMenuByUserid(Yii::$app->user->id),
                ]);
                ?>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown hidden-xs">
                        <a class="right-sidebar-toggle" aria-expanded="false">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="<?= \yii\helpers\Url::to(['site/main'])?>">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="<?= \yii\helpers\Url::to(['site/logout'])?>" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?= \yii\helpers\Url::to(['site/main'])?>" frameborder="0" data-id="<?= \yii\helpers\Url::to(['site/main'])?>" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">&copy; <?= date('Y-m-d H:i')?>
            </div>
        </div>
    </div>
    <!--右侧部分结束-->
    <!--右侧边栏开始-->
    <!--    <div id="right-sidebar">-->
    <!--        <div class="sidebar-container">-->
    <!---->
    <!--            <ul class="nav nav-tabs navs-3">-->
    <!---->
    <!--                <li class="active">-->
    <!--                    <a data-toggle="tab" href="index.html#tab-3">-->
    <!--                        <i class="fa fa-gear"></i>-->
    <!--                    </a>-->
    <!--                </li>-->
    <!--            </ul>-->
    <!---->
    <!--            <div class="tab-content">-->
    <!---->
    <!--                <div id="tab-3" class="tab-pane active">-->
    <!---->
    <!--                    <div class="sidebar-title">-->
    <!--                        <h3><i class="fa fa-gears"></i> 设置</h3>-->
    <!--                    </div>-->
    <!---->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        显示通知-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">-->
    <!--                                <label class="onoffswitch-label" for="example">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        隐藏聊天窗口-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">-->
    <!--                                <label class="onoffswitch-label" for="example2">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        清空历史记录-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">-->
    <!--                                <label class="onoffswitch-label" for="example3">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        显示聊天窗口-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">-->
    <!--                                <label class="onoffswitch-label" for="example4">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        显示在线用户-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">-->
    <!--                                <label class="onoffswitch-label" for="example5">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        全局搜索-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">-->
    <!--                                <label class="onoffswitch-label" for="example6">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="setings-item">-->
    <!--                            <span>-->
    <!--                        每日更新-->
    <!--                    </span>-->
    <!--                        <div class="switch">-->
    <!--                            <div class="onoffswitch">-->
    <!--                                <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">-->
    <!--                                <label class="onoffswitch-label" for="example7">-->
    <!--                                    <span class="onoffswitch-inner"></span>-->
    <!--                                    <span class="onoffswitch-switch"></span>-->
    <!--                                </label>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                    <div class="sidebar-content">-->
    <!--                        <h4>设置</h4>-->
    <!--                        <div class="small">-->
    <!--                            你可以从这里设置一些常用选项，当然啦，这个只是个演示的示例。-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!---->
    <!--                </div>-->
    <!--            </div>-->
    <!---->
    <!--        </div>-->
    <!---->
    <!---->
    <!---->
    <!--    </div>-->
    <!--右侧边栏结束-->

</div>
</body>