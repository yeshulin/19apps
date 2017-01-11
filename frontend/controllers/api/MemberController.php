<?php
namespace frontend\controllers\api;

use common\components\QQapi;
use Yii;
use frontend\controllers;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use \frontend\models\Member;
use frontend\models\SignupForm;
use \frontend\controllers\api\SmsController;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\captcha\CaptchaValidator;
use yii\captcha\Yanzheng;

/**
 * Site controller
 */
class MemberController extends ApiController
{
    public $enableCsrfValidation = false;//关闭csrf验证
//    private $tokenEncrypt = "newSobeyCloud";//用户接口验证
//    private $response;
    private $vboss;
    private $effectiveTime;//邮箱验证有效时间
    public $allowHash;
//    private $_user;//user identity
//    private $isLogin;
    //允许返回的字段
    public $returnField = [
        'id', 'username', 'usertype', 'email', 'nickname', 'mobile', 'sex', 'address', 'zhuanye', 'yuanxi', 'banji', 'created_at', 'linkage', 'postcode',
        'lastdate', 'loginnum', 'introduce', 'updated_at', 'regStatus'
    ];
    //允许更新的字段
    public $updateField = [
        'nickname', 'sex', 'address', 'zhuanye', 'yuanxi', 'banji', 'introduce', 'email', 'mobile', 'linkage', 'postcode',
    ];
    public $createFiled = [
        'username', 'email', 'password', 'mobile'
    ];
    public $vbossupdateField = [
        'loginname', 'username', 'email', 'password', 'mobile'
    ];
    public $randEmail = [
//        'qq.com'=>'',
//        '163.com'=>'',
//        '162.com'=>'',
//        'hotmail.com'=>'',
//        'yahoo.com'=>'',
//        'sina.com'=>'',
        'huaqiyun.com' => '',
    ];

    /*
     * 数据以JSON格式返回
     * */
    public function init()
    {
        //接口验证
//        $this->checkToken();
//        $this->isGuest();
//        $this->checkCookie();
        $this->allowHash = false;
        parent::init();
//        Yii::$app->response->cookies->removeAll();
        header("Access-Control-Allow-Origin: *");
        $this->time = time();
        $this->effectiveTime = Yii::$app->params['email_common']['effectiveTime'];
//        $this->rawBody = json_decode(Yii::$app->request->getRawBody(), true);
//        $this->response = \Yii::$app->response;
//        $this->response->format = \yii\web\Response::FORMAT_JSON;
        $this->checkLogin();
        $this->vboss = new ApiVbossController();


    }

    public function actions()
    {
//        return  [
//                 'captcha' =>
//                    [
//                        'class' => 'yii\captcha\Yanzheng',
//                        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//                    ],  //默认的写法
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'class' => 'yii\captcha\Yanzheng',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//                'backColor'=>0x000000,//背景颜色
//                'maxLength' => 5, //最大显示个数
//                'minLength' => 4,//最少显示个数
//                'padding' => 5,//间距
//                'height'=>40,//高度
//                'width' => 130,  //宽度
//                'foreColor'=>0xffffff,     //字体颜色
//                'offset'=>4,        //设置字符偏移量 有效果
//                'controller'=>'login',        //拥有这个动作的controller
//            ],
//        ];
    }
//    public function afterAction()
//    {
//        $this->response->data = $this->getReturn();
//    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $user=$this->findMember(34454);
//        var_dump($user);exit;
        $this->setReturn('', '', 'Api Success');
    }

    public function actionCaptcha()
    {
        $captcha = new Yanzheng("captcha", Yii::$app->controller);

        $captcha->maxLength = 5; //最大显示个数
        $captcha->minLength = 4;//最少显示个数
        return $captcha->run();
//        return $captcha->validate("lznva");
    }
//    public function actionCode(){
//        $pic = $this->actionCaptcha();
//    }
    public function actionYanzheng()
    {
        $captcha = new Yanzheng("captcha", Yii::$app->controller);
        $code = isset($this->rawBody['verify_code']) ? $this->rawBody['verify_code'] : '';
        if ($captcha->validate($code)) {
            $this->setReturn();
        } else {
            $this->setReturn("0003", "failed", '', "验证码错误");
        }
    }

    //用户合法注册验证
    public function actionValidate()
    {
        $types = ['loginname' => "用户名", 'email' => "邮箱", 'mobile' => "电话号码"];
        if (isset($this->rawBody['type']) && $this->rawBody['type'] != '' && array_key_exists($this->rawBody['type'], $types)) {
            if (isset($this->rawBody[$this->rawBody['type']]) && $this->rawBody[$this->rawBody['type']] != '') {
                $res = $this->vboss->vboss_check_register($this->rawBody);
                Yii::info("注册信息检测".print_r($res,true),"apiLog");
                if ($res['data']) {
                    $this->setReturn('', '', NULL);
                } else {
                    $this->setReturn("0003", "failed", '', $types[$this->rawBody['type']] . "已被注册");
                }
            } else {
                $this->setReturn("0003", "failed", '', "缺少参数" . $this->rawBody['type']);
            }
        } else {
            $this->setReturn("0003", "failed", '', "未知的验证类型");
        }
    }

    /*
     * @type
     * @loginname,email,mobile
     * */
    public function validate($info)
    {
//        $types=['loginname'=>"用户名",'email'=>"邮箱",'mobile'=>"电话号码"];
        $res = $this->vboss->vboss_check_register($info);
        return $res['data'];
    }

    /** v
     * Displays a single User model.
     */
    public function actionView()
    {
        Yii::info("用户信息获取-start", "apiLog");
//        $this->isGuest();
        if (Yii::$app->request->isPost) {
            Yii::info("用户数据接收." . print_r($this->rawBody, true), "apiLog");
            if (!empty($this->rawBody) && (isset($this->rawBody['id']) && !empty($this->rawBody['id']))) {
                Yii::info("用户信息获取:获取成功", "apiLog");
                $id = $this->rawBody['id'];
                $data = $this->filterUserinfo($this->findMember($id));
                $datas = '';
                if (!empty($data)) {
//                    foreach ($data as $k => $val) {
                    $datas[$val['id']] = $data;
//                    }
                    $this->setReturn("0000", "success", $datas);
                } else {
                    $this->setReturn("0002", "failed", '', "没有这个用户");
                }
//                else{//本地数据查找失败，拉取vboss信息
//                    if(YiI::$app->params['allowvboss']==1){
//
//                    }
//                }

            } else {
                $this->setReturn("0003", "failed", "", "参数错误");
            }
        } else {
            Yii::info("用户信息获取:非Post请求", "apiLog");
            $this->setReturn("0003", "failed", "", "请示用Post请求");
        }
        Yii::info("用户信息获取:结束", "apiLog");
//        Yii::info("用户信息获取:结束" . print_r($this->getReturn(), true), "apiLog");
    }

    /*
     * 用户登陆
     * 方式 1.用户名
     * */
    public function actionLogin()
    {
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        Yii::info("用户登录-start", "apiLog");
        //Vboss login
//        Yii::$app->cache->set('testcache[aaa]', array(1=>2));//默认有效期为一年
//        $data=Yii::$app->cache->get('testcaaache[aaa]');//默认有效期为一年
        if ($this->isLogin) {
            $this->setReturn("0002", "warining", "用户已在线");
            Yii::info("用户登录:用户已在线", "apiLog");
        } else {
            $model = new LoginForm();
            if (isset($this->rawBody['LoginForm']['loginname'])) $this->rawBody['LoginForm']['username'] = $this->rawBody['LoginForm']['loginname'];
            $data = $this->rawBody['LoginForm'];
            if ($model->load($this->rawBody) && $model->login()) {
//            $model->connectId="123456";
//            if ($model->loginByConnectId()) {
                Yii::info("用户登录:登陆成功", "apiLog");
                if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步登录
                    /*  同步登录 vboss*/
                    $vbossinfo = $this->vboss->vboss_login(array(
                        'type' => $data['type'],
                        $data['type'] => $data[$data['type']],
                        'password' => $data['password'],
                        'source' => 'sobeycollege',
                        'loginip' => Yii::$app->request->getUserIP()
                    ));
                    Yii::info("用户登录:Vboss登陆", "apiLog");
                    Yii::info("用户登录:Vboss登陆结果." . print_r($vbossinfo, true), "apiLog");
                }
                $userInfo = $this->objarray_to_array($model->_user);
//                $userInfo = $this->objarray_to_array(Member::findByUsername($model->username));
                $returninfo[$userInfo['id']] = $this->filterUserinfo($userInfo);
                if ($this->loginType == 1) {
                    $returninfo['cookie'] = $_COOKIE;
                    $this->setReturn('', '', $returninfo);
                } else {
                    $userToken = md5($userInfo['id'] . $this->token);
                    $token = explode("||", $this->sys_auth(Yii::$app->cache->get($userToken), "DECODE"));
                    if (!is_array($token) || $token[1] <= $this->time) {//用户登录已过期，重新登陆
                        Yii::$app->response->cookies->removeAll();
                        $returninfo['accessToken'] = $this->sys_auth($userInfo['id'], "ENCODE", $this->token);
//                        $caches = [$userInfo['id'], $this->time, $this->time + $this->expire, $this->token];
                        Yii::$app->cache->set($returninfo['accessToken'], $userToken);
                        Yii::$app->cache->set($userToken, $this->sys_auth($userInfo['id'] . "||" . ($this->time + $this->expire), "ENCODE"));
                        $this->setReturn('', '', $returninfo);
                    } else {
                        $this->setReturn("0002", "Warning", '', "当前用户已在线");
                    }
                }
            } else {
                Yii::info("用户登录:登陆错误，用户密码不匹配", "apiLog");
                $this->setReturn("0003", "failed", '', $model->getErrors() ? $model->getErrors() : "用户密码不匹配");
            }
        }

        Yii::info("用户登录:登陆结束", "apiLog");
//        Yii::info("用户登录:" . print_r($this->getReturn(), true), "apiLog");
//        }
    }

    public function actionHeadimg()
    {
        if (Yii::$app->request->isPost) {
            $this->guestQuit();
            $img = $this->rawBody['headimg'];
            if (empty($img)) {
                $this->setReturn("0003", "failed", '', "非法参数");
            }
            $suffix = "jpg";
            $uid = Yii::$app->user->id;
            $imgs = "";
            if (preg_match("/(data:image\/(\w+);base64,)([\s\S]+)/", $img, $match)) {
                $suffix = $match[2];
                $imgs = $match[3];
            }
            $img = base64_decode($imgs);
            //ffmpeg

            //create folder
            $name = date("Ymd");
            $avatar = Yii::$app->params['upload_path'] . "avatar" . DIRECTORY_SEPARATOR;
            $uid_1 = ceil($uid / 10000);
            $uid_2 = ceil($uid % 10000 / 1000);
            $path = $avatar . $uid_1 . DIRECTORY_SEPARATOR . $uid_2 . DIRECTORY_SEPARATOR . $uid;
            if (!is_dir($path)) {
                if (!mkdir($path, 0777, true)) {
                    $this->setReturn("0001", "failed", '', "文件目录创建失败");
                }
            }

            if (file_put_contents($path . DIRECTORY_SEPARATOR . $name . "." . $suffix, $img)) {
                $member = Member::findone(["id"=>$uid]);
                $member->headimg=Yii::$app->params['web_upload_path']."avatar" . DIRECTORY_SEPARATOR. $uid_1 . DIRECTORY_SEPARATOR . $uid_2 . DIRECTORY_SEPARATOR . $uid. DIRECTORY_SEPARATOR . $name. "." . $suffix;
                $member->delRequired();
                if($member->save()) {
                    $this->setReturn();
                }else{
                    $this->setReturn("0001", "failed", '', $member->getErrors());
                }
            } else {
                $this->setReturn("0001", "failed", '', "图片保存失败");
            }
        } else {
            $this->setReturnUsePost();
        }
    }
    public function actionImg()
    {
        if (Yii::$app->request->isPost) {
            $this->guestQuit();
            $img = $this->rawBody['img'];
            if (empty($img)) {
                $this->setReturn("0003", "failed", '', "非法参数");
            }
            $suffix = "jpg";
            $data=date("Ymd");
            $datatime=date("YmdHis");
            $rand=mt_rand(10000,99999);
            $imgs = "";
            if (preg_match("/(data:image\/(\w+);base64,)([\s\S]+)/", $img, $match)) {
                $suffix = $match[2];
                $imgs = $match[3];
            }
            $img = base64_decode($imgs);
            //ffmpeg

            //create folder
            $image = Yii::$app->params['upload_path'] . "image" . DIRECTORY_SEPARATOR;
            $path = $image . $data;
            if (!is_dir($path)) {
                if (!mkdir($path, 0777, true)) {
                    $this->setReturn("0001", "failed", '', "文件目录创建失败");
                }
            }
            $path2=$data . DIRECTORY_SEPARATOR . $datatime."_" .$rand. "." . $suffix;
            if (file_put_contents($image.$path2, $img)) {
                $url=Yii::$app->params['web_upload_path']."image" . DIRECTORY_SEPARATOR. $path2;
                    $this->setReturn('','',$url);
            } else {
                $this->setReturn("0001", "failed", '', "图片保存失败");
            }
        } else {
            $this->setReturnUsePost();
        }
    }
    public function actionGetUser()
    {
        $this->guestQuit();
        $user = $this->filterUserinfo($this->objarray_to_array($this->_user));
        $this->setReturn('', '', [$user['id'] => $user]);
    }

    public function actionLogout()
    {
//        Yii::$app->cache->flush();exit;
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        Yii::info("用户登出-start", "apiLog");
        $this->guestQuit();
//        if (isset($this->rawBody['id']) && $this->rawBody['id'] != '' && Yii::$app->getUser()->getIdentity()->getId() == $this->rawBody['id']) {
        Yii::$app->user->logout();
        if (isset($this->rawBody['accessToken'])) {
            $accessToken = $this->rawBody['accessToken'];
            $user = $this->sys_auth($accessToken, "DECODE", $this->token);
            $userToken = md5($user . $this->token);
            Yii::$app->cache->delete($accessToken);
            Yii::$app->cache->delete($userToken);
        }
        if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步登录
//                $return['data']['data'] = "Logout Success!";
            $this->vboss->vboss_logout();

        }
        $this->setReturn('', '', "退出成功");
//        }
        Yii::info("用户登出-end", "apiLog");

    }
//    public function actionSetCache(){
//        Yii::$app->cache->set("aaa","bbb");
//    }
//    public function actionGetCache(){
//        echo Yii::$app->cache->get("aaa");exit;
//    }
    /**
     * Creates a new User model.
     */
    public function actionReg()
    {
        Yii::info("用户注册-start", "apiLog");
        if (Yii::$app->request->isPost) {
            if (isset($this->rawBody['SignupForm']['loginname'])) $this->rawBody['SignupForm']['username'] = $this->rawBody['SignupForm']['loginname'];
            $goLogin = 0;
            if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步登录
//                var_dump($datavboss);exit;
                Yii::info("用户注册:vboss注册", "apiLog");
                $checkError = 0;
                $regStatus = 0;
                $model = new SignupForm();
                if (isset($this->rawBody['type'])) {
                    if ($this->rawBody['type'] == "mobile") {//电话号码注册，生成邮箱
                        Yii::info("用户注册:电话号码注册，生成邮箱", "apiLog");
                        do {
                            $this->rawBody['SignupForm']['email'] = $this->rawBody['SignupForm']['mobile'] . "@" . array_rand($this->randEmail);
                        } while (!$this->validate(["type" => "email", "email" => $this->rawBody['SignupForm']['email']]));
                        $regStatus = 1;
                    } else if ($this->rawBody['type'] == "email") {//邮箱注册，生成电话号码
                        Yii::info("用户注册:邮箱注册，生成电话号码", "apiLog");
                        do {
//                            $this->rawBody['SignupForm']['mobile'] = "1" . array_rand([3 => '', 5 => '', 7 => '', 8 => '']) . mt_rand(100000000, 999999999);
                            $this->rawBody['SignupForm']['mobile'] = "123" . mt_rand(10000000, 99999999);
                            $model->delRules('mobile', 'match');
                        } while (!$this->validate(["type" => "mobile", "mobile" => $this->rawBody['SignupForm']['mobile']]));
                        $regStatus = 3;
                    }
                }
                Yii::info("用户注册:" . print_r($this->rawBody, true), "apiLog");
                if ($model->load($this->rawBody)) {
                    if (!$model->validate()) {
                        Yii::info("用户注册:注册校验错误." . print_r($model->getErrors(), true), "apiLog");
                        $this->setReturn("0003", "failed", "", array_pop(array_pop($model->getErrors())));
                        $checkError = 1;
                    }
                }

                $datavboss = $this->rawBody['SignupForm'];
                $data['loginname'] = $datavboss['loginname'];
                $data['email'] = $datavboss['email'];
                $data['mobile'] = $datavboss['mobile'];
                $data['password'] = $datavboss['password'];
                $data['source'] = 'sobeycollege';
                $data['ip'] = Yii::$app->request->getUserIP();
                if (!$checkError) {
                    Yii::info("用户注册:Vboss注册数据." . print_r($data, true), "apiLog");
                    $vbossinfo = $this->vboss->vboss_register($data);
                    Yii::info("用户注册:vboss注册返回结果." . print_r($vbossinfo, true), "apiLog");
                    if (isset($vbossinfo['code']) && $vbossinfo['code'] == 0) {
                        $goLogin = 1;
                    }
                }
                //vboss注册失败,本地停止注册
            } else {
                Yii::info("用户注册:Vboss同步未开启", "apiLog");
//               $this->setReturn("0001","failed",'',"系统暂时关闭注册功能,请耐心等候");
            }
            #####
            if (0) {
                $model = new SignupForm();
                $regStatus = 0;
                if (isset($this->rawBody['type'])) {
                    if ($this->rawBody['type'] == "mobile") {//电话号码注册，生成邮箱
                        do {
                            $this->rawBody['SignupForm']['email'] = $this->rawBody['SignupForm']['mobile'] . "@" . array_rand($this->randEmail);
                        } while (!$this->validate(["type" => "email", "email" => $this->rawBody['SignupForm']['email']]));
                        $regStatus = 1;
                    } else if ($this->rawBody['type'] == "email") {//邮箱注册，生成电话号码
                        do {
//                            $this->rawBody['SignupForm']['mobile'] = "1" . array_rand([3 => '', 5 => '', 7 => '', 8 => '']) . mt_rand(000000000, 999999999);
                            $this->rawBody['SignupForm']['mobile'] = "123" . mt_rand(10000000, 99999999);
                            $model->delRules('mobile', 'match');
                        } while (!$this->validate(["type" => "mobile", "mobile" => $this->rawBody['SignupForm']['mobile']]));
                        $regStatus = 3;
                    }
                }
                if ($model->load($this->rawBody)) {
                    if (!$model->validate()) {
                        $this->setReturn("0003", "failed", "", array_pop(array_pop($model->getErrors())));
                        $checkError = 1;
                    }
                }
            }
            #####
            if ($goLogin) {
                //vboss注册成功,本地开始注册
                Yii::info("用户注册:本地注册开始", "apiLog");
                foreach ($this->rawBody['SignupForm'] as $k => $val) {
                    if (!in_array($k, $this->createFiled)) {
                        unset($this->rawBody['SignupForm'][$k]);
                    }
                }
                Yii::info("用户注册:用户数据过滤." . print_r($this->rawBody, true), "apiLog");
                if (array_key_exists('password', $this->rawBody['SignupForm'])) {
//                    $model = new SignupForm();
//                    if($regStatus==2) {
//                        $status=11;
//                    }else{
//                        $status=10;
//                    }
                    if (Yii::$app->session->get('openid')) {
                        $model->connectid = Yii::$app->session->get('openid');
                        Yii::$app->session->set('openid', '');
                    }
                    if (Yii::$app->session->get('from')) {
                        $model->from = Yii::$app->session->get('from');
                        Yii::$app->session->set('from', '');
                    }
                    $user = $model->signup($regStatus);
                    if ($user['code'] != "0000") {
                        Yii::info("用户注册:注册失败", "apiLog");
                        $this->setReturn("0001", "failed", '', $user['data']);
                    } else {
                        Yii::info("用户注册:注册成功", "apiLog");
                        Yii::info("用户注册:regStatus=" . $regStatus, "apiLog");
                        Yii::info("用户注册:用户信息." . print_r($user['data'], true), "apiLog");
                        if ($regStatus == 3) {
                            $sms = new SmsController();
                            $sms->actionEmail("reg", $this->rawBody['SignupForm']['email']);
                        }
                        $user = $this->filterUserinfo($this->objarray_to_array($user['data']));
                        $this->setReturn("", "", [$user['id'] => $user]);
                    }
                } else {
                    Yii::info("用户注册:密码字段为空", "apiLog");
                    $this->setReturn("0003", "failed", "", "密码不能为空");
                }
            } else {//vboss注册出错
                Yii::info("用户注册:Vboss注册出错", "apiLog");
//                if (!$checkError) $this->setReturn("0003", "failed", '', isset($vbossinfo['msg']) ? $vbossinfo['msg'] : "系统繁忙,请稍后重试");;
                $this->setReturn("0003", "failed", '', isset($vbossinfo['msg']) ? $vbossinfo['msg'] : "系统繁忙,请稍后重试");;
            }
        } else {
            Yii::info("用户注册：非Post请求", "apiLog");
            $this->setReturn("0003", "failed", "", "请使用Post请求");
        }
        Yii::info("用户注册-end", "apiLog");
//        Yii::info("用户注册-end." . print_r($this->getReturn(), true), "apiLog");
    }

    public function actionResetPwd()
    {
        Yii::info("重置密码(登陆):start", "apiLog");
        $this->guestQuit();
//        $member=New Member();
        if (Yii::$app->request->isPost) {
            Yii::info("用户数据:" . print_r($this->rawBody, true), "apiLog");
            Yii::info("当前用户Id:" . $this->_user->id, "apiLog");
            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '' && $this->_user->id == $this->rawBody['id']) {
                //新密码校验
                if (isset($this->rawBody['newPassword']) && $this->rawBody['newPassword'] != '') {
                    if ($this->rawBody['newPassword'] != $this->rawBody['oldPassword']) {
                        if (isset($this->rawBody['oldPassword']) && $this->_user->validatePassword($this->rawBody['oldPassword'])) {
                            if (strlen($this->rawBody['newPassword']) >= 6 && strlen($this->rawBody['newPassword']) <= 16) {
                                $this->UpdateBase($this->_user->id);
//                                Yii::$app->getUser()->getIdentity()->generateAuthKey();
//                                Yii::$app->getUser()->getIdentity()->setPassword($this->rawBody['newPassword']);
//                                if (!Yii::$app->getUser()->getIdentity()->save()) {
//                                    Yii::info("重置密码(登陆):重置密码出错", "apiLog");
//                                    $return['code'] = '0003';
//                                    $return['status'] = 'failed';
//                                    $return['data']['error'] = Yii::$app->getUser()->getIdentity()->getErrors();
//                                }
                            } else {
                                Yii::info("重置密码(登陆):密码应在6位到16位之间", "apiLog");
                                $this->setReturn("0003", "failed", '', "密码应在6位到16位之间");
                            }
                        } else {
                            Yii::info("重置密码(登陆):新旧密码不能一致", "apiLog");
                            $this->setReturn("0003", "failed", '', "原密码不正确");
                        }
                    } else {
                        Yii::info("重置密码(登陆):新密码不能为空", "apiLog");
                        $this->setReturn("0003", "failed", '', "新旧密码不能一致");
                    }
                } else {
                    Yii::info("重置密码(登陆):原密码不正确", "apiLog");
                    $this->setReturn("0003", "failed", '', "新密码不能为空");
                }
            } else {
                Yii::info("重置密码(登陆):无效的用户id", "apiLog");
                $this->setReturn("0003", "failed", '', "无效的用户id");
            }
        } else {
            Yii::info("重置密码(登陆):非Post请求", "apiLog");
            $this->setReturn("0003", "failed", '', "请使用Post请求");
        }
        Yii::info("重置密码(登陆):end", "apiLog");
//        Yii::info("重置密码(登陆):end." . print_r($this->getReturn(), true), "apiLog");
    }

    public function actionActive()
    {
        Yii::info("用户激活):start", "apiLog");
        if (Yii::$app->request->isPost) {
//            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '') {
            if (isset($this->rawBody['code']) && $this->rawBody['code'] != '') {
                Yii::info("用户激活:", "apiLog");
                $auth_key = md5(Yii::$app->params['auth_key']);
                Yii::info("用户激活:获取auth_key:" . $auth_key, "apiLog");
                $time = time();
                Yii::info("用户激活:时间戳:" . $time, "apiLog");
//            $hour = date('y-m-d h', $time);
//                    $this->rawBody = json_decode(Yii::$app->request->getRawBody(), true);
                $code = $this->sys_auth($this->rawBody['code'], 'DECODE', $auth_key);
                $code = explode("\t", $code);
                $emailpattern = "/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i";
//                if (is_array($code) && preg_match($emailpattern, $code[0]) && date('y-m-d h', $time) == date('y-m-d h', $code[1])) {
                if (is_array($code) && preg_match($emailpattern, $code[0]) && ($time - $code[1]) <= $this->effectiveTime) {
//                    if ($code[0] == Yii::$app->getUser()->getIdentity()->id) {
                    Yii::info("用户激活:校验正确，激活开始:" . print_r($code, true), "apiLog");
                    $this->UpdateBase('', $code[0], true);
//                    } else {
//                        $return['code'] = '0003';
//                        $return['status'] = 'failed';
//                        $return['data']['error'] = '非法操作';
//                    }
                } else {
                    Yii::info("用户激活:校验错误:" . print_r($code, true), "apiLog");
                    $this->setReturn("0003", "failed", '', "无效的code");
                }

            } else {
                Yii::info("用户激活:未检测到code:" . $code, "apiLog");
                $this->setReturn("0003", "failed", '', "非法请求");
            }
//            } else {
//                Yii::info("用户激活:无效的用户id", "apiLog");
//                $return['code'] = '0003';
//                $return['status'] = 'failed';
//                $return['data']['error'] = '无效的用户id';
//            }
        } else {
            $this->setReturnUsePost();
        }
        Yii::info("用户激活:end", "apiLog");
    }

    //密码找回
    public function actionForgetPwd($code = '')
    {
        Yii::info("重置密码(未登陆):start", "apiLog");
        if (Yii::$app->request->isPost) {
//            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '') {
            if (isset($this->rawBody['code']) && $this->rawBody['code'] != '') {
                Yii::info("重置密码(未登陆):邮箱重置密码", "apiLog");
                $auth_key = md5(Yii::$app->params['auth_key']);
                Yii::info("重置密码(未登陆):获取auth_key:" . $auth_key, "apiLog");
                $time = time();
                Yii::info("重置密码(未登陆):时间戳:" . $time, "apiLog");
//            $hour = date('y-m-d h', $time);
//                    $this->rawBody = json_decode(Yii::$app->request->getRawBody(), true);
                $code = $this->sys_auth($this->rawBody['code'], 'DECODE', $auth_key);
                Yii::info("重置密码(未登陆):code:" . print_r($code, true), "apiLog");
                $code = explode("\t", $code);
                $emailpattern = "/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i";
                if (is_array($code) && preg_match($emailpattern, $code[0]) && date('y-m-d h', $time) == date('y-m-d h', $code[1])) {
//                    if ($code[0] == Yii::$app->getUser()->getIdentity()->id) {
                    Yii::info("重置密码(未登陆):校验正确，密码重置开始:" . print_r($code, true), "apiLog");
                    $this->UpdateBase('', $code[0]);
//                    } else {
//                        $return['code'] = '0003';
//                        $return['status'] = 'failed';
//                        $return['data']['error'] = '非法操作';
//                    }
                } else {
                    Yii::info("重置密码(未登陆):校验错误:" . $code, "apiLog");
                    $this->setReturn("0003", "failed", '', "非法请求");
                }

            } else {
                $c_apisms = new SmsController();
                $return = $c_apisms->actionYanzheng(false);
                Yii::info("重置密码(未登陆):校验结果:" . print_r($return, true), "apiLog");
//                $return['code'] = "0000";
                if ($return['code'] == "0000") {
                    $id = "";
                    $mobile = Yii::$app->session->get('yzm_mobile');
                    $mid = Member::findByMobile($mobile);
                    if ($mid) {
                        $id = $mid->id;
                    } else {
                        $this->setReturn("0001", "failed", "", "数据库查找失败");
                    }
                    Yii::info("重置密码(未登陆):用户id:" . $id, "apiLog");
                    $this->UpdateBase($id);
                }
//            } else {
//                Yii::info("重置密码(未登陆):无效的用户id", "apiLog");
//                $return['code'] = '0003';
//                $return['status'] = 'failed';
//                $return['data']['error'] = '无效的用户id';
//            }
            }
            } else {
            $this->setReturnUsePost();
        }
        Yii::info("重置密码(未登陆):end", "apiLog");
//        Yii::info("重置密码(未登陆):end." . print_r($this->getReturn(), true), "apiLog");
    }

    //vboss基础信息修改
    /*
     * @id   模型id
     * @email    email
     * @isActive 是否为激活操作
     * @isReturn 是否返回数据(不中断进程)
     * */
    public function UpdateBase($id = '', $email = '', $isActive = false, $isReturn = false)
    {
        Yii::info("基础信息修改):start", "apiLog");
        $return = $this->return;
        if (Yii::$app->request->isPost) {
            $rawBody = $this->rawBody;
            isset($rawBody['Member']['loginname']) && ($rawBody['Member']['username'] = $rawBody['Member']['loginname']);
            if (isset($rawBody['newPassword'])) $rawBody['Member']['password'] = $rawBody['newPassword'];
            $datavboss = $rawBody['Member'];
            $dataTicket['type'] = "loginname";
            if ($id) {
                $member = Member::findOne($id);
            } else {
                $member = Member::findByEmail($email, false);
            }
            $member->delRequired();
            $member->delRules('mobile','match');//取消密码required属性
            $member->delRules('mobile','unique');//取消密码required属性
            $member->delRules('email','unique');//取消密码required属性
            if (!empty($member)) {
                $dataTicket['loginname'] = $member->getUsername();
                Yii::info("基础信息修改):凭证信息." . print_r($dataTicket, true), "apiLog");
                if ($isActive) {//用户激活
                    if ($member->regStatus == 3) {
                        $member->regStatus = 2;
//                        $member->delRequired();
//                        $member->delRules('mobile','match');//取消密码required属性
//                        $member->delRules('mobile','unique');//取消密码required属性
//                        $member->delRules('email','unique');//取消密码required属性
                        if ($member->save(true,null,false)) {
                            $this->setReturn("", "", "用户激活成功");
                        } else {
                            $this->setReturn("0001", "failed", "激活失败，请重试或联系管理员");
                        }
                    } else {
                        $this->setReturn("", "", "用户处于激活状态");
                    }
                } else if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步
                    Yii::info("基础信息修改):Vboss同步开始", "apiLog");
                    $vbossinfo = $this->vboss->vboss_get($dataTicket);
                    Yii::info("基础信息修改):Vboss信息获取." . print_r($vbossinfo, true), "apiLog");
//                var_dump($vbossinfo);exit;
                    if (isset($vbossinfo['code']) && $vbossinfo['code'] == 0) {
                        $id = $vbossinfo['data']['info'][0]['id'];//vboss用户id,
                    }
                    foreach ($datavboss as $k => $val) {
                        if (!in_array($k, $this->vbossupdateField)) {
                            unset($datavboss[$k]);
                        }
                    }
                    $datavboss['id'] = $id;
                    Yii::info("基础信息修改):Vboss信息更新." . print_r($datavboss, true), "apiLog");
//                $vbossinfo['code']=0;
                    $vbossinfo = $this->vboss->vboss_edit($datavboss);
                    Yii::info("基础信息修改):Vboss信息更新返回结果." . print_r($vbossinfo, true), "apiLog");
                    if (!isset($vbossinfo['code']) || $vbossinfo['code'] != 0) {
//                        $this->setReturn("0001", "failed");
                        if (isset($vbossinfo['code'])) {
                            $this->setReturn('0001', 'failed', '', $vbossinfo['msg']);
                        } else {
                            $this->setReturn('0001', 'failed', '', "系统错误,数据修改失败");
                        }
                    } else if ($vbossinfo['code'] == 0) {
                        Yii::info("基础信息修改):Vboss更新成功", "apiLog");
                        Yii::info("基础信息修改):本地数据更新开始", "apiLog");
                        $model = Member::findByUsername($dataTicket['loginname']);
                        if (isset($rawBody['Member'])) {
                            foreach ($rawBody['Member'] as $k => $val) {
                                if (!in_array($k, $this->vbossupdateField)) {
                                    unset($rawBody['Member'][$k]);
                                }
                            }
//                            $model = $this->findModel($rawBody['id']);
//                    var_dump($model);exit;
                            if (empty($model)) {
                                $this->setReturn("0002", "failed", '', "没有查找到用户信息");
//                        exit;
                            }
//                            $model = $model[0];
//                            $model->delRequired();//取消密码required属性
//                            $model->delRules('mobile','match');//取消密码required属性
                            if ($model->load($rawBody)) {
                                if (isset($rawBody['Member']['password']) && $rawBody['Member']['password'] != '') {
                                    $model->password=$rawBody['Member']['password'];
                                    // $model->setPassword($rawBody['Member']['password']);
                                }
                                if($isReturn){
                                    $res = $model->save(true,null,false);
                                }else{
                                    $res=$model->save();
                                }
                                if (!$res) {
                                    Yii::info("基础信息修改):本地数据更新失败", "apiLog");
                                    $this->setReturn("0001", "failed", '', $model->getErrors());
                                }
                                if (!$isReturn) {
                                    $this->setReturn();
                                }
                            } else {
                                Yii::info("基础信息修改):模型数据加载失败", "apiLog");
                                $this->setReturn("0001", "failed", '', "保存数据失败,数据格式不匹配");
                            }
                            Yii::info("基础信息修改):本地数据更新完成", "apiLog");
                        } else {
                            Yii::info("基础信息修改):没有传入Member信息", "apiLog");
                            $this->setReturn("0003", "failed", '', "没有传入Member信息");
                        }
                    }
                } else {
                    Yii::info("基础信息修改):Vboss同步操作未开启,更新失败", "apiLog");
                    $this->setReturn("0001", "failed", '', "同步操作未开启,更新失败");
                }
            } else {
                Yii::info("基础信息修改)：未查找到用户数据", "apiLog");
                $this->setReturn("0001", "failed", '', "未获取到数据");
            }
        } else {
            Yii::info("基础信息修改):end", "apiLog");
            $this->setReturnUsePost();
        }
//        Yii::info("基础信息修改):end." . print_r($this->getReturn(), true), "apiLog");
    }

    /**
     * Updates an existing User model.
     */
    public function actionUpdate()
    {
        Yii::info("信息修改:start", "apiLog");
        $this->guestQuit();
        if (Yii::$app->request->isPost) {
            $this->rawBody = json_decode(Yii::$app->request->getRawBody(), true);
            Yii::info("用户数据:" . print_r($this->rawBody, true), "apiLog");
            Yii::info("当前用户Id:" . Yii::$app->getUser()->getIdentity()->getId(), "apiLog");
            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '' && Yii::$app->getUser()->getIdentity()->getId() == $this->rawBody['id']) {
//            $goLogin=1;
//            if(Yii::$app->params['allowvboss']==1) { //开启vboss同步登录
////                var_dump($datavboss);exit;
//                $data['loginname']=$datavboss['loginname'];
//                $data['email']=$datavboss['email'];
//                $data['mobile']=$datavboss['mobile'];
//                $data['password']=$datavboss['password'];
//                $data['source']='sobeycollege';
//                $data['ip']=Yii::$app->request->getUserIP();
//                $vbossinfo=$this->vboss->vboss_register($data);
//                if(!isset($vbossinfo['code']) || $vbossinfo['code']!=0){
//                    $goLogin=0;//vboss注册失败,本地停止注册
//                }
//            }
                if (isset($this->rawBody['Member'])) {
                    foreach ($this->rawBody['Member'] as $k => $val) {
                        if (!in_array($k, $this->updateField)) {
                            unset($this->rawBody['Member'][$k]);
                        }
                    }

                    if (!empty($this->rawBody) && (isset($this->rawBody['id']) && !empty($this->rawBody['id']))) {
                        $model = $this->findMember($this->rawBody['id'], false);
//                    var_dump($model);exit;
                        if (empty($model)) {
                            Yii::info("信息修改):没有找到对应的用户信息", "apiLog");
                            $this->setReturn("0001", "failed", '', "没有这个用户");
//                        exit;
                        }
                        $resStatus = $model->regStatus;
                        $goVboss = 0;
                        if ($resStatus == 2 || $resStatus == 4) {//邮箱注册可以修改手机
                            if (isset($this->rawBody['Member']['email'])) unset($this->rawBody['Member']['email']);
                            $model->regStatus = 4;
                            $goVboss = 1;
                        } else if ($resStatus == 1 || $resStatus == 5) {//手机注册可以修改邮箱
                            if (isset($this->rawBody['Member']['mobile'])) unset($this->rawBody['Member']['mobile']);
                            $model->regStatus = 5;
                            $goVboss = 1;
                        } else {
                            if (isset($this->rawBody['Member']['email'])) unset($this->rawBody['Member']['email']);
                            if (isset($this->rawBody['Member']['mobile'])) unset($this->rawBody['Member']['mobile']);
                        }
                        if ($goVboss) {
                            $this->UpdateBase($model->id, '', false, true);
                        }
                        $model->delRequired();//取消密码required属性
                        $model->delRules('mobile', 'unique');//取消密码required属性
                        $model->delRules('email', 'unique');//取消密码required属性
                        $model->delRules('mobile', 'match');//取消密码required属性
                        if ($model->load($this->rawBody)) {
//                            if (isset($this->rawBody['Member']['password']) && $this->rawBody['Member']['password'] != '') {
//                                Yii::info("信息修改):密码设置", "apiLog");
//                                $model->generateAuthKey();
//                                $model->setPassword($this->rawBody['Member']['password']);

//                            }
                            if (!$model->save(true,null,false)) {
                                Yii::info("信息修改):保存数据出错", "apiLog");
                                $this->setReturn("0001", "failed", '', $model->getErrors());
                            }
                            $this->setReturn();
                        } else {
                            Yii::info("信息修改):模型加载数据出错", "apiLog");
                            $this->setReturn("0001", "failed", '', $model->getErrors());
                        }

                    } else {
                        Yii::info("信息修改):用户id为空", "apiLog");
                        $this->setReturn("0003", "failed", '', "用户id为空");
                    }
                } else {
                    Yii::info("信息修改:没有传入Member信息", "apiLog");
                    $this->setReturn("0003", "failed", '', "没有传入Member信息");
                }
            } else {
                Yii::info("信息修改:无效的用户id", "apiLog");
                $this->setReturn("0003", "failed", '', "无效的用户id");
            }
        } else {
            Yii::info("信息修改:非法Post参数", "apiLog");
            $this->setReturnUsePost();
        }
        Yii::info("信息修改:end", "apiLog");
//        Yii::info("信息修改:end。" . print_r($return, true), "apiLog");
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    protected function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * @array true返回数组，false返对象
     */
//    protected function findModel($id, $isarray = false)
//    {
//        if (($model = Member::findAll($id)) !== null) {
//            return $isarray ? $this->objarray_to_array($model) : $model;
//        } else {
//            //throw new NotFoundHttpException('The requested page does not exist.');
//            return '';
//        }
//    }

    //Get All members
    protected function findAllUser()
    {
        $posts = Yii::$app->db->createCommand('SELECT * FROM co_member')
            ->queryAll();
        return $posts;
    }

    protected function objarray_to_array($obj)
    {
        $ret = array();
        foreach ($obj as $key => $value) {
            if (in_array($key, $this->returnField)) {
                if (gettype($value) == "array" || gettype($value) == "object") {
                    $ret[$key] = $this->objarray_to_array($value);
                } else {
                    $ret[$key] = $value;
                }
            }
        }
        return $ret;
    }

    public function findMember($id, $isArray = true)
    {
        $this->setField("return", $this->returnField);
        return $this->findModel($id, $isArray, "Member");
    }

    //过滤手机邮箱
    public function filterUserinfo($model = [])
    {
        if (in_array($model['regStatus'], [2, 3])) {
            $model['mobile'] = '';
        } else if ($model['regStatus'] == 1) {
            $model['email'] = '';
        }
        unset($model['regStatus']);
        return $model;
    }

    private function checkType($str)
    {
        /*
         * email 1
         * other 0
         * */
        $emailpattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (preg_match($emailpattern, $str)) {
            return 1;
        }
        return 0;
    }

    public function guestQuit()
    {
        if ($this->isGuest()) {
            $this->setReturn("0003", "failed", '', "当前没有用户登陆");
        }
    }
}
