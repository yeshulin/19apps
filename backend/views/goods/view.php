<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Goods;
use backend\widgets\Kindedtior;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = $model->goods_name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->goods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->goods_id], [
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
            'goods_id',
            'goods_name',
            'subtitle',
            'keywords',
            [
                'attribute' => 'goods_thumb',
                'format'=> 'Html',
                'value' =>  Html::img($model->goods_thumb, ['width'=>'260px', 'height'=>'150px']),
            ],
            'price',
            'money',
            'minbuynumber',
//            'parameter:ntext',
//            [
//                'attribute' => 'parameter',
//                'format'=> 'raw',
//                'value' =>  Kindedtior::widget([
//                    'id'=>'goods_parameter',
//                    'name'=>'parameter',
//                    'value'=> $model->parameter,
//                    'toolbars'=>'null',
//                    'kindeditor'=>[
//                        'readonlyMode' => 'true'
//                    ]
//                ]),
//            ],
            [
                'attribute' => 'description',
                'format'=> 'raw',
                'value' =>  Kindedtior::widget([
                    'id'=>'goods_description',
                    'name'=>'description',
                    'value'=> $model->description,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true',
                    ]
                ]),
            ],
            [
                'attribute' => 'buyknows',
                'format'=> 'raw',
                'value' =>  Kindedtior::widget([
                    'id'=>'goods_buyknows',
                    'name'=>'buyknows',
                    'value'=> $model->buyknows,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true'
                    ]
                ]),
            ],
//            'description:ntext',
//            'buyknows:ntext',
            [
                'attribute' => 'is_new',
                'value' =>  Goods::dropDown('is_new', $model->is_new),
            ],
            [
                'attribute' => 'is_hot',
                'value' =>  Goods::dropDown('is_new', $model->is_hot),
            ],
            [
                'attribute' => 'type',
                'value' =>  Goods::dropDown('type', $model->type),
            ],
            [
                'attribute' => 'selltype',
                'value' =>  Goods::dropDown('selltype', $model->selltype),
            ],
            'association_id',
            [
                'attribute' => 'status',
                'value' =>  Goods::dropDown('status', $model->status),
            ],
            'order',
            'create_at:datetime',
            'update_at:datetime',
        ],
    ]) ?>

</div>
