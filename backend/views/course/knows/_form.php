<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\CourseKnows;

/* @var $this yii\web\View */
/* @var $model common\models\CourseKnows */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-knows-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'barsid')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(CourseKnows::dropDown('type')) ?>

    <?= $form->field($model, 'linkid')->textInput() ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <?php $this->registerJs('
    $("#courseknows-linkid").on("click", function(){
        if ($("#courseknows-type").val() == '.CourseKnows::TYPE_VIDEO.'){
            layer.open({
                type: 2,
                title: \'视频列表\',
                shadeClose: true,
                shade: 0.8,
                area: [\'50% \', \'60% \'],
                content: \''.Url::to(['video/list', 'catalogPath'=>\backend\models\Video::TYPE_COURSE]).'\' //iframe的url
            });
        }

    })
    ', \yii\web\View::POS_END)?>
</div>
