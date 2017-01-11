<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CourseSections */

$this->title = '更新: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['index', 'courseid'=>$model->courseid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    html,body{
        height: inherit;
    }
</style>
<div class="course-sections-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
