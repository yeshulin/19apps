<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Activationlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activationlog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activ_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
