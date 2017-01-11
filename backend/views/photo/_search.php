<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormPhotoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-photo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

<!--    --><?//= $form->field($model, 'userid') ?>
<!---->
<!--    --><?//= $form->field($model, 'username') ?>

    <?= $form->field($model, 'created_at') ?>
    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'looks') ?>

    <?php // echo $form->field($model, 'indeximg') ?>

    <?php // echo $form->field($model, 'college') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'arrdata') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
