<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'type')->dropDownList($model->dropDown('type'), ['prompt' => '']) ?>

    <?php //$form->field($model, 'trade_sn')->textInput(['maxlength' => true, 'disabled' => $model->isNewRecord ? false : true]) ?>

    <?php //$form->field($model, 'userid')->textInput() ?>

    <?php //$form->field($model, 'contactname')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'type')->dropDownList($model->dropDown('type')) ?>

    <?=$form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'status')->dropDownList($model->dropDown('status'), ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
