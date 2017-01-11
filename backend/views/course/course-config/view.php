<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CourseConfig */

$this->title = $model->name;
$this->params['breadcrumbs'][] =['label' => '课程列表', 'url' => ['/course/index']];
$this->params['breadcrumbs'][] = ['label' => '课程配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-config-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->course_config_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->course_config_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'course_config_id',
            'name',
            'parent',
            'order',
            'status',
        ],
    ]) ?>

</div>
