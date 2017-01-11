<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organ */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organ-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneman')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'organbook_img')->hiddenInput(['maxlength' => true]) ?>
    <?=@Html::img($model->toArray(['organbook_img'])['organbook_img'],['id'=>"organbook_img_thumb","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
<!--    --><?//= $form->field($model, 'statementtype')->textInput() ?>

<!--    --><?//= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_img')->hiddenInput(['maxlength' => true]) ?>
    <?=@Html::img($model->toArray(['headimg'])['headimg'],['id'=>"headimg_thumb","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
    <?= $form->field($model, 'card_num')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'usertype')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs('
    UploadImage("#organbook_img_thumb","","#organ-organbook_img","#organbook_img_thumb");
    UploadImage("#headimg_thumb","","#organ-headimg","#headimg_thumb");
    ', \yii\web\View::POS_END); ?>
</div>
