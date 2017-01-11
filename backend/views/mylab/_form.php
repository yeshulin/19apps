<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Mylab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mylab-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'lab_id')->textInput() ?>

    <?= $form->field($model, 'lab_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totals')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'lab_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
