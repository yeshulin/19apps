<?php
return [
	'staticUrl' => 'http://www.newcollege.com/',
	'allowvboss'=>1,//是否开启vboss同步，1为开启，0为关闭
    'vms_token' => '826d3e7325c75ed55a35527018c723cd',    //VMS_TOKEN
    'vms_path' => 'http://vms.imediax.cn:8080/vms/APIServiceReceiver',
    'adminEmail' => 'admin@example.com',
	'adminName'=>"系统管理员",
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'cache_path' => __DIR__.'/../../frontend/cache/',//文件缓存路径
    'upload_path' =>  __DIR__.'/../../frontend/web/uploads/',//上传路径
	'web_upload_path' => 'http://www.newcollege.com/uploads/',//文件访问路径
	'upload_file_size' => '5', //文件上传大小 单位 M
	'upload_exts' => array( //上传文件扩展
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
	),
	'api'=>[
		'vboss'=>'http://vboss.chinamcloud.com/api',
		'college'=>'http://www.newcollege.com/',
		'live'=>'http://101.201.70.220/index.php?r=interface/api',
		"ygc"=>"http://ygc.chinamcloud.com/",
	],
	'apikey'=>[
		'livekey'=>'I8x1Hu4wO9aEn7M2d',
		'hashToken'=>'ChinaMCloud@2016',
	],
	'appid'=>[
		'qq'=>"101267739",
		'sina'=>'2526481474',
	],
	'appkey'=>[
			'qq'=>"df112ac0bc8899cc774e226d6b65bf5c",
			'sina'=>"7717698928a4126729a6a9d35eb61cdb",
	],
	'callback'=>[
		"qq"=>"http://www.sobeycollege.com/index.php?r=auth/qq-login",
		"sina"=>"http://www.sobeycollege.com/index.php?r=auth/sina-login&callback=1"
	],
	'paysdk' => [
		'alipay' => [
			'service' => 'create_direct_pay_by_user',
			'partner' => '2088411622299002',
			'key' => 'qvkeicuskicwpz8a4338ucxmbhz10k6v',
			'_input_charset' => 'utf-8',
			'sign_type' => 'MD5',
			'payment_type' => 1,
			'notify_url' => 'http://www.newcollege.com/pay/notify',
			'return_url' => 'http://www.newcollege.com/site/order/payreturn',
			'seller_id' => '2088411622299002',
		],
	],
];
