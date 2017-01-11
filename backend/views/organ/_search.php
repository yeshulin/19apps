<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organ-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'phoneman') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'addtime') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'organbook_img') ?>

    <?php // echo $form->field($model, 'statementtype') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'headimg') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <?php // echo $form->field($model, 'recommend_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
