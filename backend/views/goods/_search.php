<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
//        'action' => ['index'],
        'method' => 'get',
        'fieldConfig'=>[
            'options'=>[
                'style'=>'float: left;with: 200px',
            ]
        ]
    ]); ?>

<!--    --><?//= $form->field($model, 'goods_id') ?>

    <?= $form->field($model, 'goods_name') ?>

    <?= $form->field($model, 'keywords') ?>

<!--    --><?//= $form->field($model, 'goods_thumb') ?>

<!--    --><?//= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'money') ?>

    <?php  echo $form->field($model, 'type')->dropDownList(\common\models\Goods::dropDown('type')) ?>

    <?php // echo $form->field($model, 'association_id') ?>

    <?php  echo $form->field($model, 'status')->dropDownList(\common\models\Goods::dropDown('status')) ?>

<!--    --><?php // echo $form->field($model, 'create_at') ?>

<!--    --><?php // echo $form->field($model, 'update_at') ?>

    <div class="field-goodssearch-type " style="float: left;width: 241px;">
        <label class="control-label" for="goodssearch-type">时间范围：</label>
        <div class="input-daterange input-group">
            <?php
            $model->create_at_start = $model->create_at_start ? date("Y-m-d", $model->create_at_start) : '';
            $model->create_at_end = $model->create_at_end ? date("Y-m-d", $model->create_at_end) : '';
            ?>
            <?= $form->field($model, 'create_at_start',[
                'template'=>'{input}'
            ])->textInput()?>
            <span class="input-group-addon">到</span>
            <?= $form->field($model, 'create_at_end',[
                'template'=>'{input}'
            ])->textInput()?>
        </div>

        <div class="help-block"></div>
    </div>


    <div class="form-group" style="padding-top: 22px">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->beginBlock('date');?>
    var start = {
        elem: '#goodssearch-create_at_start',
        format: 'YYYY/MM/DD',
        max: laydate.now(-1), //最大日期

<!--        istime: true,-->
        istoday: false,
        isclear: true,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#goodssearch-create_at_end',
        format: 'YYYY/MM/DD',
        max: laydate.now(),
<!--        istime: true,-->
        istoday: false,
        isclear: true,
        choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
    <?php
        $this->endBlock();
        $this->registerJs($this->blocks['date'])
   ?>
</div>
