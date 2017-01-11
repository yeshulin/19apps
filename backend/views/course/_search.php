<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CourseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'course_id') ?>

    <?= $form->field($model, 'course_name') ?>

    <?= $form->field($model, 'brief') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'authorid') ?>

    <?php // echo $form->field($model, 'thumb') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
