<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CourseSectionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-sections-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sectionid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'courseid') ?>

    <?= $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
