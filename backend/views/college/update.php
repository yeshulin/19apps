<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollege */

$this->title = Yii::t('backend','updateCollege').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','College'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="form-college-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
