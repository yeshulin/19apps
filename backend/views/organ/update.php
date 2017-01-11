<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organ */

$this->title = Yii::t('backend','updateOrgan').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Organ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="organ-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
