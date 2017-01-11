<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\LiveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="live-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'liveid') ?>

    <?= $form->field($model, 'live_name') ?>

    <?= $form->field($model, 'brief') ?>

    <?= $form->field($model, 'thumb') ?>

    <?= $form->field($model, 'overview') ?>

    <?php // echo $form->field($model, 'flow') ?>

    <?php // echo $form->field($model, 'scene') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
