<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\Kindedtior;

/* @var $this yii\web\View */
/* @var $model backend\models\Lab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lab_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->widget(Kindedtior::className()) ?>
<!--    --><?//= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb')->widget(Kindedtior::className(), ['widget'=> 'uploadImage']) ?>
<!--    --><?//= $form->field($model, 'thumb')->textInput(['maxlength' => true, 'id'=>'_thumb']) ?>

    <?= $form->field($model, 'lab_code')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList($model::dropDown('type')) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Lab::dropDown('status')) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<!--    --><?php
//    $this->registerJs('
//        UploadImage(\'#_thumb\',0);
//        K("#lab-brief");
//        ', \yii\web\View::POS_END);
//    ?>
</div>
