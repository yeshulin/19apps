<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ActivationCatlog;
/* @var $this yii\web\View */
/* @var $model backend\models\Activation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activation-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    --><? //= $form->field($model, 'activ_code')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'lot_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Ptype')->dropDownList(\common\models\Goods::dropDown('type')) ?>

<!--    --><?//= $form->field($model, 'type')->dropDownList(ActivationCatlog::getList()) ?>
    <?= $form->field($model, 'product_id',[
        'template' => "{label}{input}".Html::button('选择商品', ['class' => 'btn btn-success','onclick'=>'GoodsMerge()'])."{error}",
        'options'=>[
            'id'=>'merge-layer_notice',
        ],
        'labelOptions'=>[
            'style'=>'display: block;',
        ],])->textInput(['readonly'=>'readonly','style'=>"width:150px"]) ?>
    <script type="text/javascript">
        function GoodsMerge()
        {
            var pid = $("#activation-product_id").val();
            $("#activation-product_id").val('');
            lay=layer.open({
                type: 2,
                className:"fuck",
                title: '视频列表',
                shadeClose: true,
                shade: 0.8,
                area: ['50% ', '60% '],
                content: '<?= \yii\helpers\Url::to(['goods/nomerge'])?>', //iframe的url
                end:function(){
                    if($("#activation-product_id").val()==''){
                        $("#activation-product_id").val(pid);
                    }
                }
            });
//            setTimeout(function(){console.log($(".J_iframe"))},5000);
        }
    </script>
    <!--    --><? //= $form->field($model, 'make_time')->textInput() ?>

    <!--    --><? //= $form->field($model, 'status')->textInput() ?>

    <!--    --><? //= $form->field($model, 'userid')->textInput() ?>

    <!--    --><? //= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'm_userid')->textInput() ?>

    <!--    --><? //= $form->field($model, 'm_username')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'num')->textInput() ?>
    <?= $form->field($model, 'effective',[
        'template'=>"{label}"
    ])->textInput() ?>
    <?= $form->field($model, 'year',[
        'template'=>"{input}{label}\n{hint}\n{error}",
        'options'=>[
          'style'=>"display:inline"
        ],
        "errorOptions"=>[
          "style"=>"display:none"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:50px;display:inline"
        ]
    ]);?>
    <?= $form->field($model, 'month',[
        'template'=>"{input}{label}\n{hint}\n{error}",
        'options'=>[
            'style'=>"display:inline"
        ],
        'inputOptions'=>[
            "class"=>"form-control",
            "style"=>"width:50px;display:inline"
        ]
    ])->textInput() ?>
    <div class="input-daterange input-group" id="datepicker">
        <?php
        $model->end_time = $model->end_time ? date("Y-m-d", $model->end_time) : '';
        ?>
        <?= $form->field($model, 'end_time', [
            'template' => "{label}{input}",
        ])->textInput() ?>
    </div>
<!--    --><?//= $form->field($model, 'end_time')->textInput() ?>

    <script>
        $(document).ready(function() {
            laydate({
                elem: '#activation-end_time',
                format: 'YYYY/MM/DD hh:mm:ss',
                min: laydate.now(), //设定最小日期为当前日期
                istime: true,
                istoday: false,
                choose: function(datas){
                    end.min = datas; //开始日选好后，重置结束日的最小日期
                    end.start = datas //将结束日的初始值设定为开始日
                }
            });
        });
    </script>
<!--    <div type="text" id="datepicker"></div>-->
    <!--    --><? //= $form->field($model, 'videoplay_id')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'm_type')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
