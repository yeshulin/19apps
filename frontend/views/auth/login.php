<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/mlv/css/mui.min.css');
$this->registerCssFile('@web/mlv/css/login.css');
?>
<div class="am-g content">
    <div style="width:1200px;margin:0 auto;position: relative;z-index: 999;">

        <div class="loginDiv " style="display: block;"  id="login" >
            <div class="am-u-sm-12" style="padding-right: 0rem">
                <img src="<?=Url::to('@web/mlv/img/erweima.png', true)?>" style="float: right;height: 58px;" id="loginimg"/ >
            </div>
            <div class="am-u-sm-12" style="padding-left: 30px;padding-right: 30px;">
                <h4 style="font-weight: normal;">欢迎登录</h4>
                <span class="left1"></span>	<input id="f-user-name" type="text" class="am-form-field clearChromeRemeber" placeholder="邮箱/手机号/用户名" style="padding-left: 50px;margin-top: 48px;font-size: 12px;"/>
            </div>

            <div class="am-u-sm-12" style="margin-top: 21px;padding-left: 30px;padding-right: 30px;">
                <span class="left2"></span>	  <input id="f-user-psw" type="password" class="am-form-field clearChromeRemeber"  placeholder="请输入密码"style="padding-left: 50px;font-size: 12px;"/>
            </div>
            <div class="am-u-sm-12" style="margin-top: 12px;padding-left: 30px;padding-right: 30px;font-size: 12px;color: #757575;">
                <input type="checkbox" id="f-user-rem" checked="checked" style="margin-top:1px;vertical-align:middle;"/><span style="margin-bottom:-1px;margin-left: 10px;font-size: 12px;vertical-align: middle;">自动登录</span>
            </div>

            <div class="am-u-sm-12" style="margin-top: 45px;padding-left: 30px;padding-right: 30px;">
                <button id="login-bt" type="button" class="am-btn am-btn-warning" style="width: 100%;border-radius: 5px;font-size: 16px;" >登录</button>
            </div>
            <div class="am-u-sm-12" style="padding-left: 30px;padding-right: 30px;">
                <p style="width: 100%;margin-top: 15px;font-size: 12px;color: #333333;"><a href="javascript:void(0);" id="doc-prompt-toggle">忘记登录密码</a> <span style="float: right;"><a href="<?=Url::to("/auth/reg")?>">免费注册</a></span></p>
            </div>

        </div>
        <!--扫码页面-->
        <div class="loginDiv" style="display: none;" id="erm"  >
            <div class="am-u-sm-12" style="padding-right: 0rem">
                <img src="<?=Url::to('@web/mlv/img/pc_2.png', true)?>" style="float: right;" id="ermimg" />
            </div>
            <div class="am-u-sm-12" style="padding-left: 30px;padding-right: 30px;margin-top: 30px;text-align: center;">
                <h4 >手机扫码，安全登录</h4>
            </div>
            <div class="am-u-sm-12" style="padding-left: 30px;padding-right: 30px;margin-top: 50px;text-align: center;">
                <img src="<?=Url::to('@web/mlv/img/aerweima.png', true)?>" />
            </div>

            <div class="am-u-sm-12" style="margin-top: 50px;padding-left: 30px;padding-right: 30px;text-align: center;">
                <p style="font-size: 14px;">请使用买啦网客户端扫描二维码登录</p>
                <p style="text-align: center;"><span style="background-image: url(img/Download-512.png);float: left;width: 20px;height: 20px;margin-top:5px;background-repeat: no-repeat;margin-left: 100px;"></span>
                    <a style="float: left;font-size: 12px;"> 下载买啦客户端</a></p>
            </div>
            <div class="am-u-sm-12" style="margin-top: 10px;padding-left: 30px;padding-right: 30px;margin-bottom: 100px;">
            </div>

        </div>
    </div>
</div>

<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">找回密码</div>
    <div class="am-modal-bd">
        <span class="my-prompt-alert">请输入手机号或邮箱</span>
      <input type="text" class="am-modal-prompt-input">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确认</span>
    </div>
  </div>
</div>
<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt2">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">重置密码</div>
    <div class="am-modal-bd">        
        <span class="my-prompt-alert2"></span>
      <input type="text" class="am-modal-prompt-input" placeholder="请输入验证码">
      <input type="password" class="am-modal-prompt-input" placeholder="请设置新密码">
      <input type="password" class="am-modal-prompt-input" placeholder="重复新密码">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确认</span>
    </div>
  </div>
</div>
<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt3">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">重置密码</div>
    <div class="am-modal-bd">        
        <span class="my-prompt-alert3"></span>      
      <input type="password" class="am-modal-prompt-input" placeholder="请设置新密码">
      <input type="password" class="am-modal-prompt-input" placeholder="重复新密码">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
      <span class="am-modal-btn" data-am-modal-confirm>确认</span>
    </div>
  </div>
</div>
<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">恭喜您!</div>
    <div class="am-modal-bd">
       <span class="my-prompt-alert4"></span>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>
<style>
    .content-main-box{
        background-color: #ebeced;
    }
</style>
<?php
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');
    $this->registerJsFile('@web/mlv/js/mui.min.js');    
    $this->registerJsFile('@web/mlv/js/member-common.js');    
    $this->registerJsFile('@web/mlv/js/login.js');
?> 