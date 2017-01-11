<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormFeedback */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-feedback-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput(['maxlength' => true,"readonly"=>"readonly"]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true,"readonly"=>"readonly"]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>
<!--    --><?//= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'leibie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'goods_name')->textInput(['maxlength' => true,"readonly"=>"readonly"]) ?>

<!--    --><?//= $form->field($model, 'yjleibie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?php $formater= new \common\widgets\Formatter();?>
    <?= $form->field($model, 'status')->dropDownList($formater->returnStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
