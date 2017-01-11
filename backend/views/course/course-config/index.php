<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CourseConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程配置';
$this->params['breadcrumbs'][] =['label' => '课程列表', 'url' => ['/course/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-config-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建课程配置信息', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('生成配置缓存', ['cache'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'course_config_id',
            'name',
            [
                'attribute' => 'parent',
                "filter" => \common\models\CourseConfig::dropDown('parent'),
            ],
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return \common\models\CourseConfig::dropDown('type', $model->type);
                },
                "filter" => \common\models\CourseConfig::dropDown('type'),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \common\models\CourseConfig::dropDown('status', $model->status);
                },
                "filter" => \common\models\CourseConfig::dropDown('status'),
            ],
            'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
