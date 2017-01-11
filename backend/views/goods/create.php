<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = '创建商品';
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'goodsAttrModel'=>$goodsAttrModel,
    ]) ?>

</div>
