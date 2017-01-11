<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lab */

$this->title = '创建实验室: ' . $model->labid;
$this->params['breadcrumbs'][] = ['label' => '实验室列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->labid, 'url' => ['view', 'id' => $model->labid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
