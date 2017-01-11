<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Mypractical */

$this->title = $model->practical_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mypractical'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mypractical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->practical_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->practical_id], [
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
            'practical_id',
            'practical_name',
            'totals',
            'userid',
            'created_at:datetime',
            'updated_at:datetime',
            'practical_code',
            'status:serverstatus',
        ],
    ]) ?>

</div>
