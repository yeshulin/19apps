<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Advertisement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advertisement-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=$form->field($model, 'display_name')->textInput(['maxlength' => true])?>

    <?php if ($model->isNewRecord) { ?>
        <?=$form->field($model, 'type')->dropDownList($model->dropDown('type'), ['prompt' => ''])?>
        <div class="form-group addbtn">
            <button type="button" id="newpic" class="btn btn-primary hide">新增图片</button>
            <button type="button" id="newlink" class="btn btn-info hide">新增文字</button>
        </div>
    <?php }else{ $content = unserialize($model->content); ?>
        <input type="hidden" name="Advertisement[type]" value="<?=$content[0]['type']?>">
        <div class="form-group addbtn">
            <?php if($content[0]['type']==1){ ?>
                <button type="button" id="newpic" class="btn btn-primary">新增图片</button>
            <?php }elseif($content[0]['type']==2){ ?>
                <button type="button" id="newlink" class="btn btn-info">新增文字</button>
            <?php } ?>
        </div>
    <?php } ?>

    

    <div id="adcontent">
        <?=$form->field($model, 'content')->hiddenInput()?>
        <?php
        if (!$model->isNewRecord) {
            if($content){
                foreach ($content as $key => $value) {
        ?>
        <div class="form-group content">
            <input type="hidden" name="Advertisement[octype][]" value="<?=$value['type']?>"><?php if($value['type']==2){ ?><input type="text" name="Advertisement[occontent][]" class="form-control" style="width:45%;display:inline;" placeholder="文案" value="<?=$value['content']?>"><?php }elseif($value['type']==1){ ?><span style="width: 45%;display:inline-block"><input type="hidden" name="Advertisement[occontent][]" value="<?=$value['content']?>"><img class="img-responsive" src="<?=Yii::$app->params['staticUrl'].$value['content']?>"></span><?php } ?><input type="text" name="Advertisement[ocurl][]" class="form-control" style="width:45%;display:inline;" placeholder="链接网址" value="<?=$value['url']?>"><span onclick="delc(this)" style="margin-left:5px;cursor:pointer"><i class="glyphicon glyphicon-remove"></i></span>
        </div>

        <?php }}} ?>
    </div>

    <?=$form->field($model, 'status')->dropDownList($model->dropDown('status'), ['prompt' => ''])?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '提交' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
<script type="text/javascript">
    function delc(e){
        $(e).parents('.content').remove();
    }
</script>
<?php
$nore = ["\t", "\n", "\r"];
$ctype = str_replace($nore, '', $form->field($model, 'ctype[]')->hiddenInput(['value' => 1]));
$ccontent = str_replace($nore, '', $form->field($model, 'ccontent[]')->textInput());
$curl = str_replace($nore, '', $form->field($model, 'curl[]')->textInput());
$script = <<<JS
jQuery('#advertisement-type').change(function(){
    var type = $(this).val();
    $('.addbtn').find('button').addClass('hide');
    $('#adcontent').find('.content').remove();
    if(1==type){
        $('#newpic').removeClass('hide');
    }
    if(2==type){
        $('#newlink').removeClass('hide');
    }
});
jQuery('#newpic').click(function(){
    $('#advertisement-content').val('has');
    $('#adcontent').append('<div class="form-group content"><input type="hidden" class="form-control" name="Advertisement[ctype][]" value="1"><input type="file" accept="image/png,image/gif,image/jpg,image/jpeg" class="form-control" name="Advertisement[ccontent][]" style="width:45%;display: inline;" placeholder="上传图片" required><input type="text" class="form-control" name="Advertisement[curl][]" style="width:45%;display: inline;" placeholder="链接网址" required><span onclick="delc(this)" style="margin-left:5px;cursor:pointer"><i class="glyphicon glyphicon-remove"></i></span></div>');
});
jQuery('#newlink').click(function(){
    $('#advertisement-content').val('has');
    $('#adcontent').append('<div class="form-group content"><input type="hidden" class="form-control" name="Advertisement[ctype][]" value="2"><input type="text" class="form-control" name="Advertisement[ccontent][]" style="width:45%;display: inline;" placeholder="文案" required><input type="text" class="form-control" name="Advertisement[curl][]" style="width:45%;display: inline;" placeholder="链接网址" required><span onclick="delc(this)" style="margin-left:5px;cursor:pointer"><i class="glyphicon glyphicon-remove"></i></span></div>');
});
JS;
$this->registerJs($script);
?>