<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<div class="hr-line-dashed"></div>

<?//= $form->field($model, 'parent')->textInput() ?>
<?= $form->field($model, 'parent')->dropDownList($model::getMenuList(0)) ?>

<div class="hr-line-dashed"></div>

<?= $form->field($model, 'route')->textInput([
    'maxlength' => true,
//    'placeholder' => '为子菜单时，子菜单必须填写路由，否则不予显示'
]) ?>

<div class="hr-line-dashed"></div>

<?= $form->field($model, 'order')->textInput(['placeholder' => '填写数值，默认为null']) ?>

<div class="hr-line-dashed"></div>

<?= $form->field($model, 'data')->textInput() ?>

<div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('取消',['index'], ['class' => 'btn btn-white']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
