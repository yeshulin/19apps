<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylab */

$this->title = $model->lab_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mylab'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->lab_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->lab_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend','deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $formatter = new \common\widgets\Formatter();?>
    <?= DetailView::widget([
        'model' => $model,
        'formatter'=>$formatter,
        'attributes' => [
            'lab_id',
            'lab_name',
            'totals',
            'userid',
            'created_at:datetime',
            'updated_at:datetime',
            'lab_code',
            'status:serverstatus',
        ],
    ]) ?>

</div>
