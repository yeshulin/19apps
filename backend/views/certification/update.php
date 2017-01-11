<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Certification */

$this->title = '更新: ' . $model->certificationid;
$this->params['breadcrumbs'][] = ['label' => '专业认证', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->certificationid, 'url' => ['view', 'id' => $model->certificationid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
