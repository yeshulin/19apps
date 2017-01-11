<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\widgets\Kindedtior;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
/* @var $form yii\widgets\ActiveForm */
//var_dump($model->config);exit;
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brief')->widget(Kindedtior::className()) ?>

<!--    --><?//= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->widget(Kindedtior::className(), ['toolbars'=> 'full']) ?>

<!--    --><?//= $form->field($model, 'authorid')->textInput() ?>

    <!--    --><?//= $form->field($model, 'thumb')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'thumb')->widget(Kindedtior::className(), ['widget'=> 'uploadImage']) ?>

    <?= $form->field($model, 'auth_count_time',[
        'template' => "{label}\n{input}\n{hint}".Html::tag('span', '月')."\n{error}",
        'options'=>[
            'id'=>'merge-layer_notice',
        ],
        'labelOptions'=>[
            'style'=>'display: block;',
        ],
    ])->textInput(['maxlength' => true, 'style'=>'width:50px; DISPLAY: initial']) ?>

    <div id="course-config">
    <?php foreach($model->config as $v): ?>

        <?php if ($v['is_radio']): ?>
            <div class="form-group required">
                <label class="control-label"><?= $v['name']?></label>
                <div>
                    <?php /*$bool = true;*/$items=[];?>
                <?php foreach($v['items'] as $k=>$item): ?>
                    <?php $items[$item['course_config_id']] = $item['name'];?>
<!--                        --><?php //$bool = $model->isNewRecord ? ($bool ? true : false) : ((in_array($item['course_config_id'], \common\models\CourseConfigId::courseConfig($model->course_id))) ? true : false) ?>
<!--                        --><?//= Html::radio("Course[config][".$v['course_config_id']."][]", $bool,['value'=>$item['course_config_id']])?>
<!--                        --><?//= $item['name']?>
<!--                        --><?php //$bool = false;?>
                <?php endforeach; ?>
                    <?= Html::radioList("Course[config][]", \common\models\CourseConfigId::courseConfig($model->course_id),$items)?>
                </div>
                <div class="help-block"></div>
            </div>
        <?php else: ?>

            <div class="form-group required">
                <label class="control-label"><?= $v['name']?></label>
                <div>
                    <?php /*$bool = true;*/$items=[];?>
                    <?php foreach($v['items'] as $item): ?>
                        <?php $items[$item['course_config_id']] = $item['name'];?>
<!--                        --><?php //$bool = $model->isNewRecord ? ($bool ? true : false) : ((in_array($item['course_config_id'], \common\models\CourseConfigId::courseConfig($model->course_id))) ? true : false) ?>
<!--                        --><?//= Html::checkbox("Course[config][".$v['course_config_id']."][]", $bool, ['value'=>$item['course_config_id']])?>
<!--                        --><?//= $item['name']?>
<!--                        --><?php //$bool = false;?>
                    <?php endforeach; ?>
                    <?= Html::checkboxList("Course[config][]", \common\models\CourseConfigId::courseConfig($model->course_id),$items)?>
                </div>
                <div class="help-block"></div>
            </div>
        <?php endif; ?>

    <?php endforeach; ?>
    </div>

    <?= $form->field($model, 'learnnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'likenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(\common\models\Course::dropDown('type')) ?>

<!--    --><?//= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Course::dropDown('status')) ?>

<!--    --><?//= $form->field($model, 'create_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
