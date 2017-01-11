<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(\backend\models\Template::getType()) ?>

    <?= $form->field($model, 'name')->dropDownList(\backend\models\Template::getApplication()) ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'isworking')->dropDownList(\backend\models\Template::getIsWorking()) ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'userid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs('
    K("#template-content");
    ', \yii\web\View::POS_END); ?>
</div>
