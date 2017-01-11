<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Video */

$this->title = '创建视频';
$this->params['breadcrumbs'][] = ['label' => '视频列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
