<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormFeedback */

$this->title = Yii::t('backend','updateFeedback').': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="form-feedback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
