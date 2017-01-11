<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Advertisement;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AdvertisementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertisement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建广告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'display_name',
            //'content:ntext',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Advertisement::dropDown('status', $model->status); //主要通过此种方式实现
                },
                "filter" => Advertisement::dropDown('status'),
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
