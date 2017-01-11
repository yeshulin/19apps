<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'catid') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'thumb') ?>

    <?= $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'inputtime') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <?php // echo $form->field($model, 'videoPath') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
