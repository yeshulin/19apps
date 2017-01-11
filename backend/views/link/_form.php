<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Link */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkcatid')->dropDownList($model::dropDown('linkcatid')) ?>

    <?= $form->field($model, 'linktype')->dropDownList($model::dropDown('linktype')) ?>

    <?= $form->field($model, 'logo')->widget(\backend\widgets\Kindedtior::className(), ['widget'=> 'uploadImage']) ?>

    <?= $form->field($model, 'introduce')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::dropDown('status')) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script type="text/javascript">
        $("#link-linktype").change(function(){
            if ($(this).val() == <?= $model::TYPE_LOGO?>)
            {
                $(".field-link-logo").show();
            } else {
                $(".field-link-logo").hide();
            }
        })
        $("#link-linktype").change();
    </script>

</div>
