<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = '更新课程: ' . $model->course_id;
$this->params['breadcrumbs'][] = ['label' => '课程列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->course_id, 'url' => ['view', 'id' => $model->course_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
