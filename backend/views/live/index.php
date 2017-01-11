<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '直播列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建直播', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'liveid',
            'live_name',
            'brief',
//            'thumb',
//            'overview:ntext',
            // 'flow:ntext',
            // 'scene:ntext',
             'order',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return \backend\models\Live::dropDown('status', $model->status);
                },
                "filter" => \backend\models\Live::dropDown('status'),
            ],
             'create_at:datetime',
             'update_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
