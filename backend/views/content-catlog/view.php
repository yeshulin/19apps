<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentCatlog */

$this->title = $model->catid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','ContentCatlog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-catlog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->catid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->catid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend','deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'catid',
            'catname',
            'pid',
        ],
    ]) ?>

</div>
