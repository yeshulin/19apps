<?php
namespace frontend\controllers\api;

use Yii;
use backend\models\Member;
use yii\filters\VerbFilter;
use yii\httpclient\Client;

/**
 * 用户接口类，用于用户的更新，查询，添加
 */
class ApiVbossController
{
    public $enableCsrfValidation = false;//关闭csrf验证
    private $token="newSobeyCloud";//用户接口验证
    //返回数据格式
    private $return = [
        'code' => '0000',
        'status' => 'success',
        'data' => [
            'num' => 0,
            'data' => '',

        ]
    ];
    //允许返回的字段
    private $returnField;
    //允许更新的字段
    private $updateField;
    private $createFiled;
    private $response;
    private $base_url,$rigist_url,$login_url,$check_login_url,$chekc_regist_url,$edit_url,$password_url,$vboss_order_url,$mediax_downlowd_url,$get_url,$logout_url;


    /**
     * 析构函数
     * @param $ps_api_url 接口域名
     * @param $ps_auth_key 加密密匙
     */
//    public function __construct() {
//        $this->base_url='http://passport.vboss.sobey.com/api/';
//        $this->rigist_url=$this->base_url.'regist';
//        $this->login_url=$this->base_url.'login';
//        $this->check_login_url=$this->base_url.'isLogin';
//        $this->chekc_regist_url=$this->base_url.'check';
//        $this->edit_url=$this->base_url.'edit';
//        $this->password_url=$this->base_url.'password';
//        $this->get_url=$this->base_url.'get';
//        $this->logout_url=$this->base_url.'exits';
//        $this->vboss_order_url='http://api.vboss.sobey.com/order/PdtCharge';
//        $this->mediax_downlowd_url='http://mediax.sobeycache.com/version/getSoftSetup';
//    }
    /*
     * 数据以JSON格式返回
     * */
    public function __construct()
    {
        //接口验证
//        $this->tokenCheck();
        $this->base_url='http://passport.vboss.sobey.com/api/';
        $this->rigist_url=$this->base_url.'regist';
        $this->login_url=$this->base_url.'login';
        $this->check_login_url=$this->base_url.'isLogin';
        $this->chekc_regist_url=$this->base_url.'check';
        $this->edit_url=$this->base_url.'edit';
        $this->password_url=$this->base_url.'password';
        $this->get_url=$this->base_url.'get';
        $this->logout_url=$this->base_url.'exits';
        $this->vboss_order_url='http://api.vboss.sobey.com/order/PdtCharge';
        $this->mediax_downlowd_url='http://mediax.sobeycache.com/version/getSoftSetup';
    }
    private function tokenCheck(){
        $return = $this->return;
        $return['code']='0003';
        $return['status']='failed';
        $return['data']['data']='Invaild Token!';
        $data=Yii::$app->request->post();
        if(isset($data['token']) && $data['token']!=''){
            if($data['token']!=$this->token){
                exit(json_encode($return));
            }
        }else{
            exit(json_encode($return));
        }
    }
    public function actionIndex(){
        exit("This is the vboss api Class!");
        //$this->response->content="This is the vboss api Class!";
//        return $response;exit;
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


    function http_post($url,$data = array()){
//        $ch = curl_init($url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //获取数据返回
//        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE); //在启用 CURLOPT_RETURNTRANSFER 时候将获取数据返回
//        curl_setopt($ch,CURLOPT_POST,TRUE);             //设置为POST,表单式提交
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);    //POST数据
//        return curl_exec($ch);
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport' // only cURL supports the options we need
        ]);
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData($data)
            ->send();
        if ($response->isOk) {
            return $response->data;
        }
//        return null;
    }

    /**
     * [vboss_register 同步注册]
     * @param  [array] $data [username :用户名必填
     *                       email :邮箱，必填
     *                       mobile :手机号，必填
     *                       password :密码，必填［明文］]
     * @return [type]       [description]
     */
    function vboss_register($data){
        $info=$this->http_post($this->rigist_url,$data);

        //$info=json_decode($info,true);

        $param=array();
        //表示注册成功，其他都表示失败
        if(!empty($info)){
            $param=$info;
        }
        return $param;
    }

    /**
     * [vboss_login 同步登陆vboss]
     * @param  [array] $data [
     *                      type :登录类型(选填)默认为username,支持用户名username,邮箱email,手机号mobile
     *                      username :用户名，当且仅当type为username时为必填
     *                      email :邮箱，当且仅当type为email时为必填
     *                      mobile :手机号，当且仅当type为mobile时为必填
     *                      password :密码，必填［明文］]
     * @return [type]       [description]
     */
    function vboss_login($data){
        $info=$this->http_post($this->login_url,$data);

       // //$info=json_decode($info,true);

        $param=array();
        //登陆成功后返回数据
        if(!empty($info)){
            $param=$info;
        }
        return $param;
    }

    //检查是否已经登陆
    /**
     * [vboss_check_login 检查是否已经登陆]
     * @param  [array] $data [
     *                      pin:为cookie当中的pin值
     * @return [type]       [description]
     */
    function vboss_check_login($data){

        $info=$this->http_post($this->check_login_url,$data);
        $param=array();

        //if(!empty($info) && )

        return $info;
    }


    /**
     * [vboss_check_register 检查是否可以注册]
     * @param  [array] $data [
     *                       type :登录类型(选填)默认为username,支持用户名username,邮箱email,手机号mobile
     *                       login :用户名，当且仅当type为username时为必填
     *                       email :邮箱，当且仅当type为email时为必填
     *                       mobile :手机号，当且仅当type为mobile时为必填
     * @return [type]       [true/false]
     */
    function vboss_check_register($data){
        $info=$this->http_post($this->chekc_regist_url,$data);
        return $info;
    }

    /**
     * [vboss_edit 同步编辑]
     * @param  [type] $data [
     *                      id :主键。必填
     *                      username :用户名，选填
     *                      email :邮箱，选填
     *                      mobile :手机号，选填
     *                      password :密码，选填［明文］
     * @return [type]       [description]
     */
    function vboss_edit($data){

        $info=$this->http_post($this->edit_url,$data);
        //$info=json_decode($info,true);

        return $info;
    }
    /**
     * [vboss_edit 生成密码]
     * @param  [type] $data [
     *                      id :主键。必填
     *                      username :用户名，选填
     *                      email :邮箱，选填
     *                      mobile :手机号，选填
     *                      password :密码，选填［明文］
     * @return [type]       [description]
     */
    function vboss_password($data){

        $info=$this->http_post($this->password_url,$data);
        //$info=json_decode($info,true);

        return $info;
    }


    /**
     * [vboss_get 根据相关信息获取用户的基本信息]
     * @param  [type] $data [
     *                     type:类型。必填
     *                      username :用户名，选填
     *                      email :邮箱，选填
     *                      mobile :手机号，选填
     *                      password :密码，选填［明文］
     * @return [type]       [description]
     */
    function vboss_get($data){

        $info=$this->http_post($this->get_url,$data);
        //$info=json_decode($info,true);

        return $info;
    }



    /**
     * [vboss_logout 同步退出]
     * @return [type] [description]
     */
    function vboss_logout(){

        $info=$this->http_post($this->logout_url);
//        return json_decode($info,true);
        return $info;
    }



    function vboss_insert_order($data){

        $info=$this->http_post($this->vboss_order_url,$data);
//        return json_decode($info,true);
        return $info;
    }

    function vboss_mediax_download($data)
    {
        $info=$this->http_post($this->mediax_downlowd_url,$data);
//        return json_decode($info,true);
        return $info;
    }
}
