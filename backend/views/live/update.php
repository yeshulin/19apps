<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Live */

$this->title = '更新直播: ' . $model->liveid;
$this->params['breadcrumbs'][] = ['label' => '直播列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->liveid, 'url' => ['view', 'id' => $model->liveid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
