<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'send_from_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'send_to_id')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'folder')->dropDownList([ 'all' => 'All', 'inbox' => 'Inbox', 'outbox' => 'Outbox', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'status')->dropDownList(\backend\models\Message::getStatus(true)) ?>

<!--    --><?//= $form->field($model, 'message_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'replyid')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'del_type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
