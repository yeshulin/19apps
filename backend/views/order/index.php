<?php

use common\models\Order;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?=Html::encode($this->title)?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('新建订单', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'type',
            'value' => function ($model) {
                return Order::dropDown('type', $model->type); //主要通过此种方式实现
            },
            "filter" => Order::dropDown('type'),
        ],

        //'id',
        'trade_sn',
        [
            'attribute' => 'username',
            'value' => 'member.username',
            'label' => '用户名',
        ],
        'contactname',
        'phone',
        // 'address',
        // 'discount',
        // 'price',
        [
            'attribute' => 'status',
            'value' => function ($model) {
                return Order::dropDown('status', $model->status); //主要通过此种方式实现
            },
            "filter" => Order::dropDown('status'),
        ],
        [
            'attribute' => 'created_at',
            'format' => ['date', 'php:Y-m-d H:i:s'],
        ],
        // 'created_at',
        // 'updated_at',

        [
            'class' => 'backend\components\ActionColumn',
            'template'=>'{finish} {view} {update} {delete}'
        ],
    ],
]);?>
</div>
