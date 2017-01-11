<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylab */

$this->title = Yii::t('backend','update').': ' . $model->lab_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mylab'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lab_id, 'url' => ['view', 'id' => $model->lab_id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="mylab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
