<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\ActivationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'activid') ?>
<!---->
<!--    --><?//= $form->field($model, 'activ_code') ?>
<!---->
<!--    --><?//= $form->field($model, 'lot_number') ?>
<!---->
<!--    --><?//= $form->field($model, 'type') ?>

    <?= $form->field($model, 'make_time_start',[
        'template'=>"{label}{input}\n{hint}\n{error}",
        'options'=>[
            'style'=>"display:inline"
        ],
        "errorOptions"=>[
            "style"=>"display:none"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:180px;display:inline"
        ]
    ])->textInput() ?>
    <?= $form->field($model, 'make_time_end',[
        'template'=>"{label}&nbsp;{input}\n{hint}\n{error}",
        'options'=>[
            'style'=>"display:inline"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:180px;display:inline"
        ]
    ])->textInput() ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'userid') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'm_userid') ?>

    <?php // echo $form->field($model, 'm_username') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php echo  $form->field($model, 'end_time_start',[
        'template'=>"{label}{input}\n{hint}\n{error}",
        'options'=>[
            'style'=>"display:inline"
        ],
        "errorOptions"=>[
            "style"=>"display:none"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:180px;display:inline"
        ]
    ])->textInput() ?>
    <?php echo  $form->field($model, 'end_time_end',[
        'template'=>"{label}&nbsp;{input}\n{hint}\n{error}",
        'options'=>[
            'style'=>"display:inline"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:180px;display:inline"
        ]
    ])->textInput() ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'videoplay_id') ?>

    <?php // echo $form->field($model, 'm_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend',"search"), ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <script>
        $(document).ready(function() {
            laydate({
                elem: '#activationsearch-make_time_start',
                format: 'YYYY/MM/DD hh:mm:ss',
                //min: laydate.now(), //设定最小日期为当前日期
                istime: true,
                init: false
            });
            laydate({
                elem: '#activationsearch-make_time_end',
                format: 'YYYY/MM/DD hh:mm:ss',
                //min: laydate.now(), //设定最小日期为当前日期
                istime: true,
                init: false
            });
            laydate({
                elem: '#activationsearch-end_time_start',
                format: 'YYYY/MM/DD hh:mm:ss',
                //min: laydate.now(), //设定最小日期为当前日期
                istime: true,
                init: false
            });
            laydate({
                elem: '#activationsearch-end_time_end',
                format: 'YYYY/MM/DD hh:mm:ss',
                //min: laydate.now(), //设定最小日期为当前日期
                istime: true,
                init: false
            });
        });
    </script>
</div>
