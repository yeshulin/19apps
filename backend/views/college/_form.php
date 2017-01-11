<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollege */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-college-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->hiddenInput(['maxlength' => true]) ?>
    <?=@Html::img($model->toArray(['logo'])['logo'],['id'=>"logo_thumb","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
    <?= $form->field($model, 'xiaoxun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs('
    UploadImage("#logo_thumb","","#formcollege-logo","#logo_thumb");
    ', \yii\web\View::POS_END); ?>
</div>
