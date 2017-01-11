<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivationCatlog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activation-catlog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>

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
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
