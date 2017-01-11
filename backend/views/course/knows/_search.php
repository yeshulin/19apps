<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CourseKnowsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-knows-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'knowsid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'barsid') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'linkid') ?>

    <?php // echo $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
