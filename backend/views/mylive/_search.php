<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\MyliveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mylive-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'live_id') ?>

    <?= $form->field($model, 'live_name') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'tongdao') ?>

    <?= $form->field($model, 'qiehuan') ?>

    <?php // echo $form->field($model, 'liuliangbao') ?>

    <?php // echo $form->field($model, 'roomid') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
