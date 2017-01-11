<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylive */

$this->title = $model->live_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Mylive'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylive-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->live_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'delete'), ['delete', 'id' => $model->live_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $formatter = new \common\widgets\Formatter(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'formatter' => $formatter,
        'attributes' => [
            'live_id',
            'live_name',
            'userid',
            'tongdao:tongdao',
            'qiehuan:tongdao',
            'liuliang:tongdao',
            'menhu:tongdao',
            'roomid',
            'created_at:datetime',
            'updated_at:datetime',
            'status:serverstatus',
        ],
    ]) ?>

</div>
