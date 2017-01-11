<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CourseConfig */

$this->title = '更新配置: ' . $model->name;
$this->params['breadcrumbs'][] =['label' => '课程列表', 'url' => ['/course/index']];
$this->params['breadcrumbs'][] = ['label' => '课程配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->course_config_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-config-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
