<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Order;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->trade_sn;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'type',
                'value'=>  Order::dropDown('type', $model->type),
            ],
            'trade_sn',
            'userid',
            'contactname',
            'phone',
            [
                'attribute'=>'address',
                'value' => Order::getAddressInfo($model->address)
            ],
            'discount',
            'price',
            [
                'attribute' => 'status',
                'value'=>  Order::dropDown('status', $model->status),
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ]
        ],
    ]) ?>

    <h2>支付状态</h2>
    <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <td>支付方式：</td>
                <td><?=$model->orderPay->method?></td>
            </tr>  
            <tr>
                <td>状态码：</td>
                <td><?=$model->orderPay->status?></td>
            </tr>        
        </tbody>
    </table>

    <h2>订单商品</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td><b>商品</b></td>
                <td><b>购买时价格</b></td>
                <td><b>数量</b></td>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($model->orderContents as $key => $value) {
            ?>
                <tr>
                <?php 
                    $good = unserialize($value->goods_info);
                    if(empty($good['attrs'])){
                ?>
                    <td><?=$good['goods_name']?></td>
                <?php }else{ ?>
                    <td>
                        <?=$good['goods_name']?><br/>
                        <?php
                            foreach ($good['attrs'] as $k => $vo) {
                        ?>

                            &nbsp;&nbsp;[<?=$vo['name'] ?> * <?=$vo['num'] ?>]
                        
                        <?php } ?>
                    </td>

                <?php } ?>
                    <td><?=$value->price?></td>
                    <td><?=$value->num?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</div>
