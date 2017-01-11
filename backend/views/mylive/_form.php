<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mylive-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'live_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'tongdao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qiehuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'liuliang')->textInput(['maxlength' => true]) ?>\


<!--    --><?//= $form->field($model, 'roomid')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
