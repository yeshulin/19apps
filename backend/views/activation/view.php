<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Activation */

$this->title = $model->activid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Update', ['update', 'id' => $model->activid], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a('Delete', ['delete', 'id' => $model->activid], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
    <?php $formatter = new \common\widgets\Formatter();?>
    <?= DetailView::widget([
        'model' => $model,
        'formatter'=>$formatter,
        'attributes' => [
            'activid',
            'activ_code',
            'lot_number',
//            'type:ActiveType',
            'make_time:datetime',
            'status:activeStatus',
            'userid',
            'username',
            'm_userid',
            'm_username',
//            'start_time:datetime',
            'end_time:datetime',
            'effective:YYMM',
            'product_id',
//            'videoplay_id',
//            'm_type',
        ],
    ]) ?>

</div>
