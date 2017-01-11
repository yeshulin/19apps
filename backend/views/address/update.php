<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormAddress */

$this->title = 'Update Form Address: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Form Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="form-address-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
