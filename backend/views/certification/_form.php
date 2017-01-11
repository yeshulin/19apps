<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Certification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'certification_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'examtype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'studyway')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->widget(\backend\widgets\Kindedtior::className()) ?>

    <?= $form->field($model, 'people')->widget(\backend\widgets\Kindedtior::className()) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::dropDown('status')) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
