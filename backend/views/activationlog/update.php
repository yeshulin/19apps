<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Activationlog */

$this->title = 'Update Activationlog: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Activationlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activationlog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
