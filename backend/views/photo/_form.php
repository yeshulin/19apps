<?php

use yii\helpers\Html;
use \common\widgets\HtmlCustom;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\FormPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-photo-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php //if(!preg_match('/create/',Yii::$app->request->get('r'))):?>
    <!--    --><? //= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>
    <!--    --><? //= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>
    <?php //endif;?>
<!--    --><?//= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->textarea(['rows' => 6,'readonly'=>'readonly','style'=>'display:none']) ?>
    <?=Html::button(Yii::t('backend','addPhoto'),['id'=>'addPhoto'])?>
    <div id="photoShow" style="max-height:200px;overflow: scroll">
    <?=@HtmlCustom::imgs($model->toArray(['photo'])['photo'],['id'=>"img_photo","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
        </div>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'looks')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'indeximg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'college')->dropDownList($college) ?>

<!--    --><?//= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'arrdata')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<!--    --><?php //$this->registerJs('
//    var editor = KCustom("#photoShow", {
//					readonlyMode : true,
//					items:[]
//				});
//				');?>
    <?php $this->registerJs('UploadMultiImage("#addPhoto","","#formphoto-photo","#img_photo")');?>
<?php //$this->registerJs('var K_Config = {
//    uploadJson: "'.Url::to(["attached/upload/json"]).'",
//    fileManagerJson: "'.Url::to(["attached/upload/images"]).'",
//    allowFileManager: true,
//    items:["multiimage"]
//};
//KindEditor.ready(function (K) {
//        K.create("#formphoto-photo", K_Config)
//    })
//    ', \yii\web\View::POS_END); ?>
</div>
