<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Lab;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '实验室列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建实验室', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'labid',
            'lab_name',
            'brief',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Lab::dropDown('type', $model->type);
                },
                "filter" => Lab::dropDown('type'),
            ],
//            'type',
//            'link',
//             'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Lab::dropDown('status', $model->status);
                },
                "filter" => Lab::dropDown('status'),
            ],
            'order',
             'create_at:datetime',
             'update_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
