<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentCatlog */

$this->title = Yii::t('backend','updateContentCatlog').': ' . $model->catid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','ContentCatlog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->catid, 'url' => ['view', 'id' => $model->catid]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="content-catlog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
