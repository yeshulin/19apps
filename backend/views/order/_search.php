<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'type')->dropDownList($model->dropDown('type'), ['prompt' => '']) ?>

    <?= $form->field($model, 'trade_sn') ?>

    <?= $form->field($model, 'member.username') ?>

    <?= $form->field($model, 'contactname') ?>

    <?= $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php echo $form->field($model, 'status')->dropDownList($model->dropDown('status'), ['prompt' => '']) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
