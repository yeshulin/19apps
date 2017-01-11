<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/16
 * Time: 18:02
 */
?>

<div data-am-widget="tabs" class="am-tabs am-tabs-default course-descript">
    <ul class="am-tabs-nav am-cf">
        <li class="am-active"><a href="[data-tab-panel-0]">产品概述</a></li>
        <li class=""><a href="[data-tab-panel-1]">购买须知</a></li>
    </ul>
    <div class="am-tabs-bd">
        <div data-tab-panel-0 class="am-tab-panel am-active">
            <?=$data['description']?>
        </div>
        <div data-tab-panel-1 class="am-tab-panel ">
            <?=$data['buyknows']?>
        </div>
    </div>
</div>
