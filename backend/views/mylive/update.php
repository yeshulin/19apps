<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylive */

$this->title = Yii::t('backend','update').': ' . $model->live_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mylive'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->live_id, 'url' => ['view', 'id' => $model->live_id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="mylive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
