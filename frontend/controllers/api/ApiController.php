<?php

namespace frontend\controllers\api;

use Yii;
use \yii\web\Controller;
use frontend\models\Member;
use frontend\models\FormAddress;
use backend\models\Content;
use backend\models\Search\ContentSearch;
use backend\models\search\MemberSearch;
use yii\filters\VerbFilter;

/**
 * 用户接口类，用于用户的更新，查询，添加
 */
class ApiController extends Controller
{
    public $enableCsrfValidation = false;//关闭csrf验证
    public $token = "newSobeyCloud";//用户接口验证
    public $hashToken = "ChinaMCloud@2016";//hash口令
    public $rawBody;
    public $rawBodyJson;
    public $urlParam;
    public $_user;
    public $time;
    public $hashExpire=300;//hash有效时间
    public $expire = 1800;//登陆token有效时间
    public $loginType = 1;//登陆方式，1为cookie登陆，2为token登陆
    public $isLogin;
    public $response;
//    public $allowHash=true;//是否开启验证
    public $allowHash=false;//是否开启验证
    //返回数据格式
    public $return = [
        'code' => '0000',
        'msg' => 'success',
        'data' => '',
    ];
    //允许返回的字段
    public $returnField;
    //允许更新的字段
    private $updateField;
    private $createFiled;

    /*
     * 数据以JSON格式返回
     * */
    public function init()
    {
        //接口验证
//        $this->tokenCheck();
//        $this->isGuest();
//        $this->checkCookie();
        parent::init();
        $this->time=time();
        $this->response = \Yii::$app->response;
        $this->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $this->checkLogin();
        $this->rawBody = json_decode(Yii::$app->request->getRawBody(), true);
        if(empty($this->rawBody)){
            $this->rawBody = Yii::$app->request->post();
        }
        $this->urlParam=Yii::$app->request->get();
//        $this->createHash();
        if($this->allowHash) {
            $this->checkHash();
        }
        Yii::info("访问地址：" .$this->urlParam , "apiLog");
        Yii::info("接收数据：" . print_r($this->rawBody, true), "apiLog");
//        Yii::info("接收数据Json：" . print_r($this->rawBodyJson, true), "apiLog");
    }

    /*
     *hash值被附带在url请求地址中
     *          ex>http://www.newcollege.com/?r=api/member/index&hash=myHash
     *验证每次api请求所带的hash值
     * *hash值生成方式
     *              \common\helpers\Encrypt::sys_auth(当前时间戳, "ENCODE", $hashToken);
     *              返回值为加密的字符串
    */
    public function checkHash()
    {
        $hash=$this->urlParam['hash'];
        if(empty($hash)){
           $this->setReturn("0003","failed",'',"空的hash值");
        }
        $token=$this->sys_auth($hash,"DECODE",$this->hashToken);
        if(!is_numeric($token) ||($token+$this->hashExpire) < $this->time){
            $this->setReturn("0003","failed",'',"无效的hash值");
        }
    }
    //For Test
    public function createHash()
    {
        $token=$this->sys_auth($this->time,"ENCODE",$this->hashToken);
        var_dump($token);exit;
    }
    //检测是否有cookie
    protected function checkCookie()
    {
        $cookie = Yii::$app->request->cookies->toArray();
        $return = empty($cookie) ? false : true;
        return $return;
    }

    public function checkLogin()
    {
        $this->isLogin = false;
        if ($this->checkCookie()) {
            if (!Yii::$app->user->isGuest) {
                $this->isLogin = true;
                $this->_user = Yii::$app->getUser()->getIdentity();
            }
        } else if ($this->checkToken()) {
            $this->isLogin = true;
        }
    }

    //token校验
    protected function checkToken()
    {
        Yii::$app->user->logout();
        $data = json_decode(Yii::$app->request->getRawBody(), true);
        $return = false;
        (isset($data['isToken']) && $data['isToken']) ? $this->loginType = 2 : '';
        if (isset($data['accessToken']) && $data['accessToken'] != '') {
            $this->loginType = 2;
            $token = Yii::$app->cache->get($data['accessToken']);
//            $user=$this->sys_auth($token,"DECODE",$this->token);
//            $userToken=md5($token);
            $token = explode("||", $this->sys_auth(Yii::$app->cache->get($token), "DECODE"));
            if (is_array($token)) {
                $user = $this->findModel($token[0], true, "Member");
                if (!empty($user) && ($token[1] >= $this->time)) {
                    $this->_user = $user[0];
                    $return = true;
                }
            }
        }
        return $return;
    }

    //判断是否登陆
    protected function isGuest()
    {
//        $request=Yii::$app->request->get('r');
//        if(!preg_match("/login/",$request)) {
        if (!$this->isLogin) {
//                $this->setReturn("0003","failed",'',"当前没有用户登录");
            return true;
        }
        return false;
//        }
    }

    /**
     * 字符串加密、解密函数
     *
     *
     * @param    string $txt 字符串
     * @param    string $operation ENCODE为加密，DECODE为解密，可选参数，默认为ENCODE，
     * @param    string $key 密钥：数字、字母、下划线
     * @param    string $expiry 过期时间
     * @return    string
     */
    protected function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0)
    {
        return \common\helpers\Encrypt::sys_auth($string, $operation, $key , $expiry);
    }

    /**
     * @inheritdoc
     *
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
//    public function getReturn(){
//        return self::$return;
//    }
    /*
     * code 状态码
     * msg  消息体
     * data 返回数据
     * error 返回错误
     * return array
     * */
    protected function setReturn($code = "0000", $msg = "success", $data = "", $error = "")
    {
        $return = $this->return;
        if (empty($code)) {
            if (empty($return['code'])) {
                $return['code'] = "0000";
            }
        } else {
            $return['code'] = $code;
        }
        if (empty($msg)) {
            if (empty($return['msg'])) {
                $return['msg'] = "success";
            }
        } else {
            $return['msg'] = $msg;
        }
        if (!empty($data) || $data === NULL) {
            $return['data'] = $data;
            unset($return['error']);
        } else {
            $return['error'] = $error;
            unset($return['data']);
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->data = $return;
        Yii::$app->response->send();
//        return $return;
    }

    protected function setReturnUsePost()
    {
        $this->setReturn("0003", "", '', "请使用Post请求");
    }

    //设置返回限制字段
    public function setField($filed, $val)
    {
        switch ($filed) {
            case "return":
                $this->returnField = $val;
                break;
            default:
                break;
        }
    }

    /**
     * @id
     * @array true返回数组，false返对象
     * @modelName 模型
     * @namespace 命名空间前缀
     */
    protected function findModel($id, $isarray = false, $modelName, $namespace = "\\frontend\\models\\")
    {
        $models = $namespace . $modelName;
        if (($model = $models::findAll($id)) !== null) {
            return $isarray ? $this->objarray_to_array($model[0]) : $model[0];
        } else {
            //throw new NotFoundHttpException('The requested page does not exist.');
            return '';
        }
    }
    //Get All members
//    protected function findAllUser(){
//        $posts = Yii::$app->db->createCommand('SELECT * FROM co_member')
//            ->queryAll();
//        return $posts;
//    }
    protected function objarray_to_array($obj)
    {
        $ret = array();
        foreach ($obj as $key => $value) {
            if (array_intersect(["*", $key], $this->returnField)) {
                if (gettype($value) == "array" || gettype($value) == "object") {
                    $ret[$key] = $this->objarray_to_array($value);
                } else {
                    $ret[$key] = $value;
                }
            }
        }
        return $ret;
    }
}
