<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/mlv/css/sui.css');
?>

<link rel="stylesheet" href="<?=Url::to('@web/mlv/css/regedit.css', true)?>">
<style>
    /*.bottomLine {
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        margin-bottom: 10px;
        /*padding: 10px;*/
    /*padding-top: 10px;
    padding-bottom: 10px;
    word-spacing: 0.05rem;
    text-align: center;
    margin-top: 82px;*/
    /*width:677px ;*/
    /*line-height: ;*/
    /*}*/

    .bottomLine{
        border-bottom: 1px solid #ccc;
        border-top: 1px solid #ccc;
        padding-top:8px;
        /*padding-bottom:10px;*/

    }
    .bot {
        margin-bottom: 50px;
        /*text-align: center;*/
        color: #7b6f5b;
    }

    .radio-pretty.checked > span:before {
        color: #f88600;
    }

    input {
        height: 62px;
    }
    .radio-pretty span:before {
        margin-right: 2px;
        vertical-align: -4px;
        font-size: 20px;
        color: #bdbdbd;
        margin-left: -2px;
    }
    .am-tab-panel > div{
        visibility: hidden;
    }
     .content{
        display: none;
     } 
     [data-am-widget=tabs] .am-tabs-nav li {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
}
.am-tabs-d2 .am-tabs-nav>.am-active .am-round{
    background-color: #fa8f00;
}
</style>

<div class="am-g content" tag="phone" style="margin-top: 12px;display: block;">
    <div data-am-widget="tabs" class="am-tabs am-tabs-d2" data-am-tabs-noswipe="1">
        <ul class="am-tabs-nav am-cf" style="margin-top: 74px;">
            <li class="" style="max-width: 95px; margin-left: 100px;"></li>
            <li class="am-active"><a id="r-phone-a1" href="[data-tab-panel-0]"><span class="am-badge am-round" style="vertical-align: middle;margin-top:-4px;">1</span>用户信息</a></li>
            <li class=""><a id="r-phone-a2" href="[data-tab-panel-1]"><span class="am-badge  am-round"style="vertical-align: middle;margin-top:-4px;">2</span>发送验证码</a></li>
             <li class=""><a id="r-phone-a3" href="[data-tab-panel-2]"><span class="am-badge  am-round"style="vertical-align: middle;margin-top:-4px;">3</span>注册成功</a></li>
            <li class="" style="    max-width: 95px;margin-right: 100px;"></li>
        </ul>
        <div class="am-tabs-bd" style="margin-top: 59px;">
            <div data-tab-panel-0 class="am-tab-panel am-active">
                <div style="visibility: visible;">
                
                    <div class="am-g">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left1"></span> <input type="text" id="r-phone" placeholder="请输入您的手机号" class="am-form-field" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px" /> </div>
                        <div class="am-u-sm-1 am-u-end" style="padding: 10px;"> <span class="right" style="display: none;"></span> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left4"></span> <input type="text" id="r-userName" placeholder="请输入用户名" class="am-form-field clearChromeRemeber" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px;" /> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left3"></span> <input type="password" id="r-passWord" placeholder="请输入密码" class="am-form-field clearChromeRemeber" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px;" /> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-4 am-u-sm-offset-3" style="padding-right: 0rem;"> <span class="left2"></span> <input type="text" id="r-imgScode" placeholder="请输入验证码" class="am-form-field" style="margin: auto;display: block;float: left;padding-left: 55px;width: 360px" /> </div>
                        <div class="am-u-sm-3 am-u-end" style="padding-left: 0rem;"> <button id="r-imgScode-bt" type="button" class="am-btn am-btn-default" style="width: 209px;float: left;height: 62px;"><img src="<?=Url::to("/api/member/captcha")?>" style="width: 80px;height: 35px;" alt=""><a style="margin-left: 20px;">换一张</a></button> </div>
                    </div>
                    <div class="am-g" style="margin-top: 21px;">
                        <form class="sui-form">
                            <div class="am-u-sm-7 am-u-sm-offset-3" style="padding-right: 0rem;"> <label class="checkbox-pretty inline checked"> <input id="r-allowCk" type="checkbox"  checked="checked"><span style="font-size: 12px;color: #878787;">同意<a>《注册协议》</a></span> </label> </div>
                        </form>
                    </div>
                    <div class="am-g" style="margin-top: 56px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <button type="button" id="phone-reg-bt" class="am-btn am-btn-warning" style="width: 528px;padding: 20px;border: 1px rgba(187, 187, 187, 0.5) solid;"><font style="font-size: 20px;font-weight: bold;">同意协议并注册</font></button> </div>
                    </div>
                    <div class="am-g" style="margin-top: 20px;margin-bottom: 35px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3" style="padding-right: 0rem;"> <a id="use-email" href="javascript:void(0);" style="font-size: 14px;">您也可以使用邮箱注册></a> </div>
                    </div>
            
             
                </div>
            </div>
            <!-- 发送验证码 -->
              <div data-tab-panel-1 class="am-tab-panel">
                <div>                
                  
                    <div class="am-g">
                        <div class="am-u-sm-4 am-u-sm-offset-3" style="padding-right: 0rem;"> <span class="left2"></span><input id="sCode1" type="text" placeholder="请输入短信验证码" class="am-form-field" style="margin: auto;display: block;float: left;padding-left: 55px;width: 360px;" /> </div>
                        <div class="am-u-sm-3 am-u-end" style="padding-left: 0rem;"> <button type="button" id="sCode1-bt" class="am-btn am-btn-default" style="width: 209px;float: left;height: 62px;">获取短信验证码</button> </div>
                    </div>
                                       
                    <div class="am-g" style="margin-top: 56px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <button type="button" id="phone-reg-bt2" class="am-btn am-btn-warning" style="width: 528px;padding: 20px;border: 1px rgba(187, 187, 187, 0.5) solid;"><font style="font-size: 20px;font-weight: bold;">同意协议并注册</font></button> </div>
                    </div>
                   
                         
                </div>
            </div>          
            <!--成功-->
            <div data-tab-panel-2 class="am-tab-panel ">
            <div>
                
                <div class="am-g" style="margin-top: 90px;">
                    <div class="am-u-sm-6 am-u-sm-offset-3 " style="    text-align: center;">
                        <h2 id="r-phone-success" style="color: #8F8F8F;font-size: 20px;"></h2> </div>
                </div>
                <div class="am-g" style="line-height:14px;margin-top: 12px;">
                    <div class="am-u-sm-6 am-u-sm-offset-5 "> <a style="font-size: 14px;color: #4689cb;margin-top: 4px;" href="<?=Url::to("/auth/login")?>" id="r-phone-success2"></a> </div>
                </div>
                <div class="am-g" style="margin-top: 176px;margin-bottom: 124px;">
                    <!-- <div class="am-u-sm-6 am-u-sm-offset-3 "> <button type="button" class="am-btn am-btn-warning" style="width: 100%;height: 62px;font-size: 20px;font-weight: bold;border: 1px rgba(187, 187, 187, 0.5)B solid;">完成</button> </div> -->
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="am-g content" tag="email" style="margin-top: 12px;">
    <div data-am-widget="tabs" class="am-tabs am-tabs-d2" data-am-tabs-noswipe="1">
        <ul class="am-tabs-nav am-cf" style="margin-top: 74px;">
            <li class="" style="max-width: 95px; margin-left: 100px;"></li>
            <li class="am-active"><a href="[data-tab-panel-0]" id="r-email-a1"><span class="am-badge am-round" style="vertical-align: middle;margin-top:-4px;">1</span>用户信息</a></li>
            <li class=""><a href="[data-tab-panel-1]" id="r-email-a2"><span class="am-badge  am-round"style="vertical-align: middle;margin-top:-4px;">2</span>邮箱激活</a></li>
             <li class=""><a href="[data-tab-panel-2]" id="r-email-a3"><span class="am-badge  am-round"style="vertical-align: middle;margin-top:-4px;">3</span>激活成功</a></li>
            <li class="" style="    max-width: 95px;margin-right: 100px;"></li>
        </ul>
        <div class="am-tabs-bd" style="margin-top: 59px;">
            <div data-tab-panel-0 class="am-tab-panel am-active">
                <div style="visibility: visible;">
                
                    <div class="am-g">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left5"></span> <input type="text" id="r-email" placeholder="请输入您的邮箱地址" class="am-form-field" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px" /> </div>
                        <div class="am-u-sm-1 am-u-end" style="padding: 10px;"> <span class="right" style="display: none;"></span> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left4"></span> <input type="text" id="r-userName-e" placeholder="请输入用户名" class="am-form-field clearChromeRemeber" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px;" /> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <span class="left3"></span> <input type="password" id="r-passWord-e" placeholder="请输入密码" class="am-form-field clearChromeRemeber" style="margin: auto;display: block;float: left;padding-left: 55px;width: 528px;" /> </div>
                    </div>
                    <div class="am-g" style="margin-top: 37px;">
                        <div class="am-u-sm-4 am-u-sm-offset-3" style="padding-right: 0rem;"> <span class="left2"></span> <input type="text" id="r-imgScode-e" placeholder="请输入验证码" class="am-form-field" style="margin: auto;display: block;float: left;padding-left: 55px;width: 360px" /> </div>
                        <div class="am-u-sm-3 am-u-end" style="padding-left: 0rem;"> <button id="r-imgScode-e-bt" type="button" class="am-btn am-btn-default" style="width: 209px;float: left;height: 62px;"><img src="<?=Url::to("/api/member/captcha")?>" style="width: 80px;height: 35px;" alt=""><a style="margin-left: 20px;">换一张</a></button> </div>
                    </div>
                    <div class="am-g" style="margin-top: 21px;">
                        <form class="sui-form">
                            <div class="am-u-sm-7 am-u-sm-offset-3" style="padding-right: 0rem;"> <label class="checkbox-pretty inline checked"> <input id="r-allowCk-e" type="checkbox"  checked="checked"><span style="font-size: 12px;color: #878787;">同意</span><a>《注册协议》</a> </label> </div>
                        </form>
                    </div>
                    <div class="am-g" style="margin-top: 56px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3 "> <button type="button" id="email-reg-bt" class="am-btn am-btn-warning" style="width: 528px;padding: 20px;border: 1px rgba(187, 187, 187, 0.5) solid;"><font style="font-size: 20px;font-weight: bold;">同意协议并注册</font></button> </div>
                    </div>
                    <div class="am-g" style="margin-top: 20px;margin-bottom: 35px;">
                        <div class="am-u-sm-7 am-u-sm-offset-3" style="padding-right: 0rem;"> <a id="use-phone" href="javascript:void(0);" style="font-size: 14px;">您也可以使用手机注册></a> </div>
                    </div>
            
             
                </div>
            </div>
            <!-- 邮箱激活 -->
            
              <div data-tab-panel-1 class="am-tab-panel">
                <div>                
                  
                   <div class="am-g" style="margin-top: 90px;">
                    <div class="am-u-sm-6 am-u-sm-offset-3 " style="    text-align: center;">
                        <h2 style="color: #8F8F8F;font-size: 20px;">恭喜您注册成功！激活邮件已经发送请注意查收。</h2> </div>
                </div>
                <div class="am-g" style="line-height:14px;margin-top: 12px;">
                    <div class="am-u-sm-6 am-u-sm-offset-5 "> 
                     <a style="font-size: 14px;color: #4689cb;margin-top: 4px;" href="<?=Url::to("/auth/login")?>" id="r-email-success2"></a>
                    
                </div>
                </div>
                <div class="am-g" style="margin-top: 176px;margin-bottom: 124px;">
                    <!-- <div class="am-u-sm-6 am-u-sm-offset-3 "> <button type="button" class="am-btn am-btn-warning" style="width: 100%;height: 62px;font-size: 20px;font-weight: bold;border: 1px rgba(187, 187, 187, 0.5)B solid;">完成</button> </div> -->
                </div>
                   
                         
                </div>
            </div>          
            <!--成功-->
            <div data-tab-panel-2 class="am-tab-panel ">
            <div>
                <!--<div class="am-g"> <div class="am-u-sm-12" style="text-align: center;"> <img src="img/lion.png" /> </div> </div>-->
                <div class="am-g" style="margin-top: 90px;">
                    <div class="am-u-sm-6 am-u-sm-offset-3 " style="    text-align: center;">
                        <h2 style="color: #8F8F8F;font-size: 20px;">恭喜您，152******64账号注册成功</h2> </div>
                </div>
                <div class="am-g" style="line-height:14px;margin-top: 12px;">
                    <div class="am-u-sm-6 am-u-sm-offset-5 "> <a style="font-size: 14px;color: #4689cb;margin-top: 4px;">点击查看</a> </div>
                </div>
                <div class="am-g" style="margin-top: 176px;margin-bottom: 124px;">
                    <div class="am-u-sm-6 am-u-sm-offset-3 "> <button type="button" class="am-btn am-btn-warning" style="width: 100%;height: 62px;font-size: 20px;font-weight: bold;border: 1px rgba(187, 187, 187, 0.5)B solid;">完成</button> </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    
    $this->registerJsFile('@web/mlv/js/amazeui.min.js');
    $this->registerJsFile('@web/mlv/js/sui.js');    
    $this->registerJsFile('@web/mlv/js/member-common.js');    
    $this->registerJsFile('@web/mlv/js/reg.js');
?> 