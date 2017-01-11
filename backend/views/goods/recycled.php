<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '回收站商品';
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goods_id',
            'goods_name',
//            'keywords',
//            'goods_thumb',
            'price',
             'money',
             'type',
            // 'association_id',
             'status',
             'create_at:datetime',
             'update_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view} {update}",
            ],
        ],
    ]); ?>
</div>
