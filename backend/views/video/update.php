<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Video */

$this->title = '更新视频: ' . $model->videoid;
$this->params['breadcrumbs'][] = ['label' => '视频列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->videoid, 'url' => ['view', 'id' => $model->videoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="video-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
