<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormFeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'created_at') ?>
    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'leibie') ?>

    <?php // echo $form->field($model, 'goods_name') ?>

    <?php // echo $form->field($model, 'yjleibie') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
