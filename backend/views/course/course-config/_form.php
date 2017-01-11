<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CourseConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->dropDownList(\common\models\CourseConfig::dropDown('parent')) ?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\CourseConfig::dropDown('type'))?>

    <?= $form->field($model, 'is_radio')->dropDownList([1=>'是', 0=>'否']) ?>


    <?= $form->field($model, 'status')->dropDownList(\common\models\CourseConfig::dropDown('status')) ?>


    <?= $form->field($model, 'order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <script type="text/javascript">
        $("#courseconfig-parent").on("click", function(){
//            console.log(2);
            if ($(this).val() == 0)
            {
                $(".field-courseconfig-type").show();
            }else {
                $(".field-courseconfig-type").hide();
            }
        })
        $("#courseconfig-parent").click();
    </script>
</div>
