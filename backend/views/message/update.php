<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = Yii::t('backend',"update").': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t("backend","Message"), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend',"update");
?>
<div class="message-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
