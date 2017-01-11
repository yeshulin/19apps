<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-collection-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'userid')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rz_head_img')->hiddenInput(['maxlength' => true]) ?>
    <?=@Html::img($model->toArray(['rz_head_img'])['rz_head_img'],['id'=>"headimg_thumb","width"=>"150px","height"=>"150px","title"=>"点击更换图片","style"=>"cursor:pointer"])?>
    <?= $form->field($model, 'zskvideo')->textInput(['maxlength' => true,'onclick'=>"javascript:Vms()"]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'looks')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'college')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'college')->dropDownList($college) ?>

<!--    --><?//= $form->field($model, 'looknum')->textInput() ?>

    <?= $form->field($model, 'rz_content_img')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'goodcomment')->textInput() ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <script type="text/javascript">
        function Vms()
        {
            var args = '&args=1,gif|jpg|jpeg|png|bmp,0,,';
            var setting = '&module=video&catid=18&authkey=7270ea10918986369519e02228d6c452&textareaid=formcollection-zskvideo';
            var params='&server=<?=Yii::$app->params['vms_url']?>servlet/MakingTranscodeUploadServlet.jsp&siteId=<?=Yii::$app->params['vms_siteid']?>&host=<?=Yii::$app->params['vms_url']?>Upload&isPublish=1&m=video&c=upload&a=swfupload'+args+setting;
//            var params='?server='+vms_url+'servlet/MakingTranscodeUploadServlet.jsp&siteId='+vms_siteid+'&host='+vms_url+'Upload&isPublish=1&m=video&c=upload&a=swfupload'+args+setting;
//            layer.open({
//                type: 2,
//                title: '视频列表',
//                shadeClose: true,
//                shade: 0.8,
//                area: ['50% ', '60% '],
//                content: '<?//= \yii\helpers\Url::to(['collection/swfupload'])?>//'+params //iframe的url
//            });
        }
    </script>
    <?php ActiveForm::end(); ?>
    <?php $this->registerJs('
    UploadImage("#headimg_thumb","","#formcollection-rz_head_img","#headimg_thumb");
    ', \yii\web\View::POS_END); ?>
<!--	--><?php //$this->registerJs("
//        videoupload('video_img_images', '上传视频','info[zskvideo]',thumb_images,'1,gif|jpg|jpeg|png|bmp,0,,','video','18','{upload_key(\'1,gif|jpg|jpeg|png|bmp,0,,\')}')
//	", \yii\web\View::POS_END); ?>
</div>
