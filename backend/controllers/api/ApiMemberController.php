<?php

namespace backend\controllers\api;

use backend\models\AuthAssignment;
use Yii;
use backend\models\Member;
use backend\models\search\MemberSearch;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\form\MemberForm;

/**
 * 用户接口类，用于用户的更新，查询，添加
 */
class ApiMemberController extends \backend\controllers\AdminController
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
    private $returnField=[
        'userid','username','usertype','email','nickname','mobile','sex','address','zhuanye','yuanxi','banji','created_at',
        'lastdate','loginnum','introduce','updated_at'
    ];
    //允许更新的字段
    private $updateField=[
        'username','email','nickname','mobile','sex','address','zhuanye','yuanxi','banji','introduce'
    ];
    private $createFiled=[
        'username','email','password'
    ];

   /*
    * 数据以JSON格式返回
    * */
    public function init()
    {
        //接口验证
//        $this->tokenCheck();
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $return = $this->return;
        $return['data']['data']='Api Sucess!';
        return $return;
    }

    /**
     * Displays a single User model.
     */
    public function actionView()
    {
        $return=$this->return;
        if(Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            if(!empty($postData) && (isset($postData['id']) && !empty($postData['id']))){
                $id=$postData['id'];
                $data=$this->findModel($id,true);
                $datas='';
                if(!empty($data)) {
                    foreach ($data as $k => $val) {
                        $datas[$val['userid']] = $val;
                    }
                }
                $return['data']['num']=empty($datas)?0:count($datas);
                $return['data']['data']=$datas;
            }else{
                $return['code']='0003';
                $return['status']='failed';
                $return['data']['data']='Illegal Parameters!';
            }
        }else{
            $return['code']='0003';
            $return['status']='failed';
            $return['data']['data']='Invaild Operation!Use POST instead!';
        }
        return $return;
    }
    public function actionLogin()
    {
//        var_dump(Yii::$app->member->isGuest);exit;
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }

        $model = new MemberForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            echo 1;exit;
            return $this->goBack();
        } else {
            echo 2;exit;
            $this->layout = 'main_layout';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Creates a new User model.
     */
    public function actionReg()
    {
        $return=$this->return;
        if(Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            foreach($postData['Member'] as $k => $val){
                if(!in_array($k,$this->createFiled)){
                    unset($postData['Member'][$k]);
                }
            }
            if(array_key_exists('password',$postData['Member'])) {
                $password = $postData['Member']['password'];
                $model = new Member();
                if ($model->load($postData)) {
                    $model->setPassword($password);
                    if (!$model->save()) {
                        $erros=$model->getFirstErrors();
                        $return['code']='0001';
                        $return['status']='failed';
                        $return['data']['data']='Create failed!';
                        $return['data']['error']=$erros;
                    }else {

                        $return['data']['num']=1;
                        $user=$this->objarray_to_array($model);
                        $return['data']['data'][$user['userid']] = $user;
                    }
                } else {
                    var_dump($model->getFirstErrors());
                    exit;
                }
            }else{
                $return['code']='0003';
                $return['status']='failed';
                $return['data']['data']='Password must be required!';
            }
        }else{
            $return['code']='0003';
            $return['status']='failed';
            $return['data']['data']='Invaild Operation!Use POST instead!';
        }
        return $return;
    }

    /**
     * Updates an existing User model.
     */
    public function actionUpdate()
    {
        $return=$this->return;
        if(Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            foreach($postData['Member'] as $k => $val){
                if(!in_array($k,$this->updateField)){
                    unset($postData['Member'][$k]);
                }
            }
            if (!empty($postData) && (isset($postData['id']) && !empty($postData['id']))) {
                $model = $this->findModel($postData['id'])[0];
                if(empty($model)){
                    $return['code']='0002';
                    $return['status']='failed';
                    $return['data']['data']='No such data';
                    return $return;exit;
                }
                $model->delRules('password', 'required');//取消密码required属性
                if($model->load($postData)) {
                    if (Yii::$app->request->post('Member')['password'] != '') {
                        $model->setPassword(Yii::$app->request->post('password'));
                    }
                    if (!$model->save()) {
                        $return['code'] = '0001';
                        $return['status'] = 'failed';
                        $return['data']['data'] = 'Updated failed!';
                    }
                }else{
                    $return['code'] = '0001';
                    $return['status'] = 'failed';
                    $return['data']['data'] = 'Load data failed!';
                }

            }else{
                $return['code']='0003';
                $return['status']='failed';
                $return['data']['data']='Illegal Parameters!';
            }
        }else{
            $return['code']='0003';
            $return['status']='failed';
            $return['data']['data']='Invaild Operation!Use POST instead!';
        }
        return $return;
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    protected function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    @array true返回数组，false返对象
     */
    protected function findModel($id,$isarray=false)
    {
        if (($model = Member::findAll($id)) !== null) {
            return $isarray?$this->objarray_to_array($model):$model;
        } else {
            //throw new NotFoundHttpException('The requested page does not exist.');
            return '';
        }
    }
    //Get All members
    protected function findAllUser(){
        $posts = Yii::$app->db->createCommand('SELECT * FROM co_member')
            ->queryAll();
        return $posts;
    }
    private function objarray_to_array($obj) {
        $ret = array();
        foreach ($obj as $key => $value) {
            if(in_array($key,$this->returnField)) {
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
