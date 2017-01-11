<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CertificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'certificationid') ?>

    <?= $form->field($model, 'certification_name') ?>

    <?= $form->field($model, 'examtype') ?>

    <?= $form->field($model, 'studyway') ?>

    <?= $form->field($model, 'object') ?>

    <?php // echo $form->field($model, 'brief') ?>

    <?php // echo $form->field($model, 'people') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
