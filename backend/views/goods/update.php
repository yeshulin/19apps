<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = '更新商品: ' . $model->goods_name;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->goods_name, 'url' => ['view', 'id' => $model->goods_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'goodsAttrModel'=>$goodsAttrModel,
    ]) ?>

</div>
