<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Practical */

$this->title = '更新实训: ' . $model->practicalid;
$this->params['breadcrumbs'][] = ['label' => '实训列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->practicalid, 'url' => ['view', 'id' => $model->practicalid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practical-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
