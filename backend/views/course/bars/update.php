<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CourseBars */

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['/course/course-sections/index', 'courseid'=>$model->courseid]];
$this->params['breadcrumbs'][] = ['label' => '小节列表', 'url' => ['index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-bars-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
