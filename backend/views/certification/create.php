<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Certification */

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '专业认证', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
