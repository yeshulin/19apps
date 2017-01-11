<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = '编辑订单: ' . $model->trade_sn;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trade_sn, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑订单';
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
