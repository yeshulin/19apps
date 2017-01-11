<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'catid')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'thumb')->hiddenInput(['maxlength' => true]) ?>
    <?=@Html::img($model->toArray(['thumb'])['thumb'],['id'=>"img_thumb","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>

<!--    --><?//= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'inputtime')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'updatetime')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'videoPath')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs('
    K("#content-content");
    UploadImage("#img_thumb","","#content-thumb","#img_thumb");
    ', \yii\web\View::POS_END); ?>
</div>
