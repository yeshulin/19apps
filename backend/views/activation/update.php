<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Activation */

$this->title = 'Update Activation: ' . $model->activid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activation'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->activid, 'url' => ['view', 'id' => $model->activid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
