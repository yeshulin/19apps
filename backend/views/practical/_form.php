<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\Kindedtior;

/* @var $this yii\web\View */
/* @var $model backend\models\Practical */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practical-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'practical_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->widget(Kindedtior::className()) ?>
    <!--    --><?//= $form->field($model, 'brief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb')->widget(Kindedtior::className(), ['widget'=> 'uploadImage']) ?>
    <!--    --><?//= $form->field($model, 'thumb')->textInput(['maxlength' => true, 'id'=>'_thumb']) ?>

    <?= $form->field($model, 'type')->dropDownList(\backend\models\Practical::dropDown('type')) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Practical::dropDown('status')) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<!--    --><?php
//    $this->registerJs('
//        UploadImage(\'#_thumb\',0);
//
//        ', \yii\web\View::POS_END);
//    ?>
</div>
