<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = $model->course_id;
$this->params['breadcrumbs'][] = ['label' => '课程列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$navTabs = [
    [
        'label'=>'课程详情',
        'url'=>Url::to(['info','id'=>$model->course_id]),
    ],
    [
        'label'=>'课程章节',
        'url'=> Url::to(['course/course-sections/index','courseid'=>$model->course_id]),
    ],
];
$data['model'] = $model;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="tabs-container">
            <ul class="nav nav-tabs" id="course-nav">
                <?php foreach($navTabs as $k=>$v): ?>
                    <li>
                        <a data-toggle="tab" data-href="<?= $v['url']?>" aria-expanded="true"> <?= $v['label']?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
<!--                    <div class="panel-body">-->
                        <iframe class="J_iframe" id="J_iframe" name="iframe0" width="100%" scrolling="no" onload="this.height=document.body.offsetHeight" src="" frameborder="0" seamless></iframe>
<!--                    </div>-->
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $("#course-nav").find("li").on("click",function(){
                if($(this).hasClass('active')){
                    return false;
                }
                var href = $(this).find("a").attr("data-href");
                $('#J_iframe')[0].src=href;
                $(this).siblings().removeClass('active');
                $(this).addClass('active')
            })
            $("#course-nav").find("li")[0].click();
        </script>
    </div>