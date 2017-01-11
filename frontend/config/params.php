<?php
return [
    'adminEmail' => 'admin@example.com',
    'auth_key' => 'g2fCzDdFxnNBXYUPpz1B', //密钥
//    'web_url'=>'www.newcollege.dev',
    'web_url'=>'www.newcollege.com',
    'fogetpwd_route'=>'auth/login',
    'register_route'=>'auth/active',
    'email_common'=>[
        'admin_email' => '532264001@qq.com',
        'maxloginfailedtimes' => '8',
        'minrefreshtime' => '2',
        'mail_type' => '1',
        'mail_server' => 'smtp.qq.com',
        'mail_port' => '25',
        'category_ajax' => '0',
        'mail_user' => '48015200',
        'mail_auth' => '1',
        'mail_from' => '48015200@qq.com',
        'mail_password' => 'kidchanLQ',
        'errorlog_size' => '20',
        'effectiveTime'=>60*60*24*2,//邮箱有效时间，48小时
    ],
    'member_common'=>[
        'picUrl'=>'http://www.newcollege.com/mlv/img/banner.png',//图片地址
        'allowvobss' => '1',
        'allowregister' => '1',
        'choosemodel' => '1',
        'enablemailcheck' => '1',
        'enablcodecheck' => '0',
        'mobile_checktype' => '0',
        'user_sendsms_title' => '',
        'registerverify' => '0',
        'showapppoint' => '0',
        'enroll_discount' => '',
        'rmb_jingbi_rate' => '1',
        'rmb_point_rate' => '10',
        'monetary' => '500',
        'poundage' => '10',
        'defualtpoint' => '0',
        'defualtamount' => '0',
        'showregprotocol' => '0',
        'regprotocol' => '欢迎注册19apps，请仔细阅读条款！',
//        'registerverifymessage' => ' <div style="color:red">欢迎您注册成为华栖云学院用户，您的账号需要邮箱认证，点击下面链接进行认证：{click}或者将网址复制到浏览器：{url}</div>',
        'registerverifymessage' => '<div style="width:600px">
	<div>
		<img src="{picUrl}" title="这里是我们的logo" alt="这里是我们的logo">
	</div>
	<div style="border-top:1px orange solid;border-bottom:1px orange solid"></div>
	<div>
		{username},您好：<br><br>
		您于{datetime}提交了{action}申请。<br><br>
		点击一下链接，{action}:<br>
		{url}<br>
		（该链接在48小时内有效，48小时后需要重新提交）<br><br>
	<p style="text-align:right;">华栖云客服中心<br>
		{date}<br><br></p>
		如果以上链接无法访问，请将该网址复制并粘贴至新的浏览器窗口中
本邮件由系统自动发送，请勿直接回复！如有任何疑问，请联系我们的客服人员。
	</div>
</div>',
//        'forgetpassword' => '华栖云学院密码找回，请在一小时内点击下面链接进行操作：{click}
//或者将网址复制到浏览器：{url}',
    ]
];
