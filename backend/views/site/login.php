<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->beginBlock('location');
?>
if(window.top !== window.self){ window.top.location = window.location;}
<?php $this->endBlock('location') ?>
<?php $this->registerJs($this->blocks['location'],\yii\web\View::POS_HEAD) ?>
<body class="mosaic-bg" style="font-family: 'microsoft yahei">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div class="b-login-box">
            <div>
                <img src="<?= \yii\helpers\Url::to('@web/statics/images/b-login-logo.png') ?>" alt="">
            </div>
            <h3 style="margin: 32px 0;" class="f36 color-bcbcbc font-noraml">华栖云教 <span class="f16">后台管理系统</span></h3>
            <?php $form = ActiveForm::begin(['class' => 'm-t']); ?>
            <div class="b-login-input">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>"用户名"])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true,'placeholder'=>"密码"])->label(false) ?>
            </div>


            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group" style="padding-top: 20px;">
                <?= Html::submitButton('登陆', ['class' => 'btn btn-primary block m-b', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</body>


