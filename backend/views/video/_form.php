<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vmsid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'videoname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'thumb')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'userid')->textInput() ?>

<!--    --><?//= $form->field($model, 'usertype')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(\backend\models\Video::dropDown('type')) ?>

    <?= $form->field($model, 'status')->dropDownList(\backend\models\Video::dropDown('status')) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php $this->registerJs('
    UploadImage(\'#video-thumb\',0);
//    $("#video-vmsid").on("click", function(){
//        layer.open({
//            type: 2,
//            title: \'Vms视频列表\',
//            shadeClose: true,
//            shade: 0.8,
//            area: [\'50% \', \'60% \'],
//            content: \'' . Url::to(['video/vms-video']) . '\' //iframe的url
//        });
//    })
    ', \yii\web\View::POS_END)?>

</div>
