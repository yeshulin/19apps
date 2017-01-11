<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\Goods;
use backend\widgets\Kindedtior;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="goods-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'goods_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <!--    --><?//= $form->field($model, 'goods_thumb')->textInput(['maxlength' => true,'accept'=>'image/*','id'=>'inputImage']) ?>

    <?= $form->field($model, 'goods_thumb')->widget(Kindedtior::className(), ['widget'=> 'uploadImage']) ?>


    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>
    <p>
        <?= Html::button('新增参数', ['class' => 'btn btn-success', 'onclick'=>'goodsAttrModelAdd(this)']) ?>
    </p>

    <blockquote class="text-warning" style="font-size:14px">
        <font style="color: red">*</font>、参数类型\输入类型\键\名称\价格 不能为空。
    </blockquote>
    <div id="goodsAttrModel">
    <?php foreach($model->goodsAttr as $k=> $goodsAttr){ ?>
        <div class="goodsAttrModel">
            <div class="field-goodsattr-attrtype" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-attrtype">参数类型</label>
                <?= Html::dropDownList('GoodsAttr[attrtype][]', $goodsAttr->attrtype, \common\models\GoodsAttr::dropDown('attrtype'), ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-attrtype" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-attrtype">输入类型</label>
                <?= Html::dropDownList('GoodsAttr[inputtype][]', $goodsAttr->inputtype, \common\models\GoodsAttr::dropDown('inputtype'), ['class' => 'form-control']) ?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-key" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-key">键</label>
                <?= Html::input('text', 'GoodsAttr[key][]', $goodsAttr->key, ['class'=>'form-control'])?>

                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-name" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-name">名称</label>
                <?= Html::input('text', 'GoodsAttr[name][]', $goodsAttr->name, ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-money" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-money">价格</label>
                <?= Html::input('text', 'GoodsAttr[money][]', $goodsAttr->money, ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div style="float: left;margin: 34px 0 0 5px;cursor: pointer"><i onclick="deal(this)" class="glyphicon glyphicon-remove"></i></div>
            <div style="clear: both;"></div>
        </div>
    <?php } ?>
    </div>
    <?= $form->field($model, 'minbuynumber')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'parameter')->widget(Kindedtior::className()) ?>

    <?= $form->field($model, 'description')->widget(Kindedtior::className(), ['toolbars'=> 'full']) ?>

    <?= $form->field($model, 'buyknows')->widget(Kindedtior::className(), ['toolbars'=> 'full']) ?>

    <?= $form->field($model, 'is_new')->dropDownList(Goods::dropDown('is_new')) ?>

    <?= $form->field($model, 'is_hot')->dropDownList(Goods::dropDown('is_hot')) ?>

    <?= $form->field($model, 'type')->dropDownList(Goods::dropDown('type'),['disabled'=>true]) ?>

    <?= $form->field($model, 'selltype')->dropDownList(Goods::dropDown('selltype')) ?>

    <?php if ($model->type == $model::TYPE_MERGE): ?>

        <?= $form->field($model, 'goods_merge',[
            'template' => "{label}\n{input}\n{hint}".Html::button('选择商品', ['class' => 'btn btn-success','onclick'=>'GoodsMerge()'])."\n{error}",
            'options'=>[
                'id'=>'merge-layer_notice',
            ],
            'labelOptions'=>[
                'style'=>'display: block;',
            ],
        ])->textInput(['maxlength' => true, 'style'=>'width:200px; DISPLAY: initial']) ?>
        <script type="text/javascript">

            function GoodsMerge()
            {
                layer.open({
                    type: 2,
                    title: '视频列表',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['50% ', '60% '],
                    content: '<?= \yii\helpers\Url::to(['goods/nomerge'])?>' //iframe的url
                });
            }
        </script>

    <?php else: ?>

<!--        --><?//= $form->field($model, 'type')->dropDownList(Goods::dropDown('type')) ?>

    <?php endif; ?>
<!--['disabled'=>true]-->

<!--    --><?//= $form->field($model, 'association_id')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList(Goods::dropDown('status')) ?>
<!---->
<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div id="goodsattr" class="hide">
        <div class="goodsAttrModel">
            <div class="field-goodsattr-attrtype required" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-attrtype">参数类型</label>
                <?= Html::dropDownList('GoodsAttr[attrtype][]', '', \common\models\GoodsAttr::dropDown('attrtype'), ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-attrtype required" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-attrtype">输入类型</label>
                <?= Html::dropDownList('GoodsAttr[inputtype][]', '', \common\models\GoodsAttr::dropDown('inputtype'), ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-key required" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-key">键</label>
                <?= Html::input('text', 'GoodsAttr[key][]', '', ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-name required" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-name">名称</label>
                <?= Html::input('text', 'GoodsAttr[name][]', '', ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div class="field-goodsattr-money required" style="width: 100px;float: left;">
                <label class="control-label" for="goodsattr-money">价格</label>
                <?= Html::input('text', 'GoodsAttr[money][]', '', ['class'=>'form-control'])?>
                <div class="help-block"></div>
            </div>
            <div style="float: left;margin: 34px 0 0 5px;cursor: pointer">
                <i onclick="deal(this)" class="glyphicon glyphicon-remove"></i>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>

    <script type="text/javascript">
        function deal(e)
        {
            $(e).parent().parent().remove();
        }
        function goodsAttrModelAdd(e)
        {
            $("#goodsAttrModel").append($("#goodsattr").html())
        }

    </script>
<!--    --><?php
//        $this->registerJs('
//        UploadImage(\'#inputImage\',0);
//        K("#goods-parameter");
//        K("#goods-description");
//        K("#goods-buyknows");
//        ', \yii\web\View::POS_END);
    ?>
</div>
