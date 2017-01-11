<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'form-horizontal',
    ],
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-sm-10\">\n{input}\n</div>",
        'labelOptions' => ['calss' => "control-label col-sm-2 ", 'style' => 'position: relative; min-height: 1px;padding-right: 15px;padding-left: 15px; padding-top: 7px; margin-bottom: 0;text-align: right;width: 16.66666667%;  float: left;'],
    ]
]); ?>
<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
<div class="hr-line-dashed"></div>
<?= $form->field($model, 'headimg')->HiddenInput() ?>
<?=@Html::img($model->toArray(['headimg'])['headimg'],['id'=>"img_headimg","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
<div class="hr-line-dashed"></div>
<?= $form->field($model, 'mobile')->textInput(['autofocus' => true]) ?>

<div class="hr-line-dashed"></div>

<?= $form->field($model, 'email') ?>

<div class="hr-line-dashed"></div>

<?= $form->field($model, 'password')->passwordInput() ?>

<div class="hr-line-dashed"></div>
<? //= $form->field($model, 'role')->dropDownList(\backend\models\Role::getRoles())?>
<?php if ($model->getErrors()!=''): ?>
    <div class="form-group field-member-email required has-error">
        <div class="col-sm-10" style="padding-left:169px">
            <div class="form-control"
                 style="color:red;border:0;background:initial"><?= @array_pop($model->getErrors())[0] ?></div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
<?php endif; ?>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('取消', ['index'], ['class' => 'btn btn-white']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php $this->registerJs('var K_Config={uploadJson:"' . Url::to(['attached/upload/json']) . '",fileManagerJson:"' . Url::to(['attached/upload/images']) . '",allowFileManager:true};function K(obj){KindEditor.ready(function(K){K.create(obj,K_Config)})};function UploadImage(Obj,Type,TextObj){TextObj=TextObj==undefined?Obj:TextObj;var showRemote=true,showLocal=true;if(Type==1){showRemote=false}else if(Type==2){showLocal=false}KindEditor.ready(function(K){var editor=K.editor(K_Config);K(Obj).click(function(){editor.loadPlugin("image",function(){editor.plugin.imageDialog({showRemote:showRemote,showLocal:showLocal,imageUrl:K(TextObj).val(),clickFn:function(url,title,width,height,border,align){K(TextObj).val(url);editor.hideDialog()}})})})})}', \yii\web\View::POS_HEAD); ?>
<?php $this->registerJs('
    K("#content-content");
    UploadImage("#img_headimg","","#member-headimg","#img_headimg");
    ', \yii\web\View::POS_END); ?>

