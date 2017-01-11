<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Advertisement */

$this->title = '创建广告';
$this->params['breadcrumbs'][] = ['label' => '广告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertisement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>