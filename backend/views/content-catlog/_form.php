<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ContentCatlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-catlog-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'catid')->textInput() ?>

    <?= $form->field($model, 'catname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
