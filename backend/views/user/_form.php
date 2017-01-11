<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <div class="hr-line-dashed"></div>

<?= $form->field($model, 'email') ?>

    <div class="hr-line-dashed"></div>

<?= $form->field($model, 'password')->passwordInput() ?>

<!--    <div class="hr-line-dashed"></div>-->

<?= $form->field($roleModel, 'name')->dropDownList(\backend\models\Role::getRoles())?>

    <div class="hr-line-dashed"></div>

<?= $form->field($model, 'status')->dropDownList([$model::STATUS_ACTIVE=>'正常',$model::STATUS_DELETED=>'屏蔽']) ?>

    <div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('取消',['index'], ['class' => 'btn btn-white']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>