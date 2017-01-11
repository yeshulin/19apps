<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Mypractical */

$this->title = Yii::t('backend','create').': ' . $model->practical_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mypractical'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->practical_id, 'url' => ['view', 'id' => $model->practical_id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="mypractical-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
