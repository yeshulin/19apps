<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\MessageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'send_from_id') ?>

    <?= $form->field($model, 'send_to_id') ?>

    <?= $form->field($model, 'folder') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'message_time') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'replyid') ?>

    <?php // echo $form->field($model, 'del_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
