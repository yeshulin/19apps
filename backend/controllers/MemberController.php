<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use Yii;
use frontend\models\Member;
use backend\models\search\MemberSearch;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class MemberController extends AdminController
{
    private $vboss;
    private $vbossupdateField =[
        'loginname','username', 'email', 'password','mobile'
    ];
    //允许更新的字段
    private $updateField = [
        'username', 'email', 'nickname', 'mobile', 'sex', 'address', 'zhuanye', 'yuanxi', 'banji', 'introduce', 'password','headimg'
    ];
    /**
     * @inheritdoc
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

    public function init(){
        $this->vboss = new \frontend\controllers\api\ApiVbossController();
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //var_dump(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id));
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();
		$model->delRules('username', 'required');//取消required属性
		$model->delRules('password', 'required');//取消required属性
        $model->delRules('mobile', 'required');//取消required属性
        $model->delRules('email', 'required');//取消required属性
        if(Yii::$app->request->isPost) {
            $postData=Yii::$app->request->post();
            $datavboss = $postData['Member'];
            if (isset($datavboss['username'])) $datavboss['loginname'] = $datavboss['username'];
//            var_dump($datavboss);
//            exit;
            $goLogin = 1;
            $model->load($postData);
            if(!$model->validate()){
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步登录
//                var_dump($datavboss);exit;
                $data['loginname'] = $datavboss['loginname'];
                $data['email'] = $datavboss['email'];
                $data['mobile'] = $datavboss['mobile'];
                $data['password'] = $datavboss['password'];
                $data['source'] = 'sobeycollege';
                $data['ip'] = Yii::$app->request->getUserIP();
                $vbossinfo = $this->vboss->vboss_register($data);
                Yii::info("后台用户创建:vboss返回信息，".print_r($vbossinfo,true),"apiLog");
                if (!isset($vbossinfo['code']) || $vbossinfo['code'] != 0) {
                    $model->addErrors($vbossinfo);
                    $goLogin = 0;//vboss注册失败,本地停止注册
                }
            }
            if ($goLogin) {
                    $model->setStatus();
                    $model->password=$datavboss['password'];
                    // $model->generateAuthKey();
                    // $model->setPassword(Yii::$app->request->post('password'));
                    if ($model->save()) {
                        Yii::info("后台用户创建:本地创建成功.".$model->id,"apiLog");
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
            }
        }
        $model->roleName = null;
        return $this->render('create', [
            'model' => $model,
        ]);

    }
    public function actionUpdate($id){
        $model = $this->findModel($id);
		$model->delRules('username', 'required');//取消required属性
		$model->delRules('password', 'required');//取消required属性
        $model->delRules('mobile', 'required');//取消required属性
        $model->delRules('email', 'required');//取消required属性
//        $model->delRules('password','required');
        Yii::info("后台用户数据更新,start","apiLog");
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            isset($postData['Member']['username']) && $postData['Member']['loginname']=$postData['Member']['username'];
            $datavboss = $postData['Member'];
            $dataTicket['type']="loginname";
            $dataTicket['loginname']=$model->getUsername();
            Yii::info("后台用户数据更新:获取更新用户，".$dataTicket['loginname'],"apiLog");
            if (Yii::$app->params['allowvboss'] == 1) { //开启vboss同步
                Yii::info("后台用户数据更新:Vboss同步更新开始","apiLog");
                $vbossinfo = $this->vboss->vboss_get($dataTicket);
                $id='';
                if(isset($vbossinfo['code']) && $vbossinfo['code']==0){
                    $id=$vbossinfo['data']['info'][0]['id'];//vboss用户id,
                }
                if(!empty($id)) {
                    Yii::info("后台用户数据更新:Vboss用户获取成功.".$id,"apiLog");
                    foreach ($datavboss as $k => $val) {
                        if (!in_array($k, $this->vbossupdateField)) {
                            unset($datavboss[$k]);
                        }
                    }
                    $datavboss['id'] = $id;
//                $vbossinfo['code']=0;
                    Yii::info("后台用户数据更新:Vboss提交更新内容".print_r($datavboss,true),"apiLog");
                    $vbossinfo = $this->vboss->vboss_edit($datavboss);
                    if (!isset($vbossinfo['code']) || $vbossinfo['code'] != 0) {//vboss更新失败，本地数据库不更新email,mobile,username字段

                        $return['code'] = '0001';
                        $return['status'] = 'failed';
                        if (isset($vbossinfo['code'])) {
                            $return['data']['error'] = $vbossinfo['msg'];
                        } else {
                            $return['data'] = "系统错误，数据修改失败";
                        }
                        Yii::info("后台用户数据更新:Vboss同步更新失败","apiLog");
                        Yii::info("Vboss更新失败:".print_r($return,true),"apiLog");
                       if(isset($postData['Member']['email'])){
                           unset($postData['Member']['email']);
                       }
                        if(isset($postData['Member']['mobile'])){
                            unset($postData['Member']['mobile']);
                        }
                        if(isset($postData['Member']['username'])){
                            unset($postData['Member']['username']);
                        }
                    }
                    Yii::info("后台用户数据更新:本地数据库更新","apiLog");
                    Yii::info("后台用户数据更新:提交更新内容".print_r($postData,true),"apiLog");
//                    $model = Member::findByUsername($dataTicket['loginname']);
                    if (isset($postData['Member'])) {
                        foreach ($postData['Member'] as $k => $val) {
                            if (!in_array($k, $this->updateField)) {
                                unset($postData['Member'][$k]);
                            }
                        }
//                            $model = $this->findModel($postData['id']);
//                    var_dump($model);exit;
                        Yii::info("后台用户数据更新:允许更新内容".print_r($postData,true),"apiLog");
                        if (empty($model)) {
//                            $return['code'] = '0002';
//                            $return['status'] = 'failed';
//                            $return['data']['data'] = 'No such data';
//                            return $return;
                            Yii::info("后台用户数据更新:更新失败，未获取到改用户信息","apiLog");
                            return $this->render('update', [
                                'model' => $model,
                            ]);
//                        exit;
                        }
//                            $model = $model[0];
                        $model->delRules('password', 'required');//取消密码required属性
                        $model->delRules('mobile', 'required');//取消密码required属性
                        $model->delRules('email', 'required');//取消密码required属性
                        $model->delRules('email', 'unique');//取消密码required属性
                        $model->delRules('mobile', 'unique');//取消密码required属性
                        if ($model->load($postData)) {
                            if (isset($postData['Member']['password']) && $postData['Member']['password'] != '') {
                                Yii::info("后台用户数据更新:密码设置","apiLog");
                                $model->setStatus();
                                $model->password=$postData['Member']['password'];
                                // $model->generateAuthKey();
                                // $model->setPassword($postData['Member']['password']);
                            }
                            if ($model->save()) {
//                                    $return['code'] = '0001';
//                                    $return['status'] = 'failed';
//                                    $return['data']['data'] = 'Updated failed!';
//                                    $return['data']['error'] = $model->getErrors();
                                Yii::info("后台用户数据更新:更新成功.".$model->id,"apiLog");
                                return $this->render('view', [
                                    'id' => $model->id,
                                    'model' => $model,
                                ]);
                            }
                            Yii::info("后台用户数据更新:更新失败",print_r($model->getErrors(),true),"apiLog");
                        }
                        Yii::info("后台用户数据更新:更新失败",print_r($model->getErrors(),true),"apiLog");
                    }
                }else {
                    $model->addErrors(["username" => "Vboss:" . $vbossinfo['msg']]);
                }
                Yii::info("后台用户数据更新:Vboss用户获取失败","apiLog");
                Yii::info("后台用户数据更新:操作失败","apiLog");
            }
        }
        Yii::info("后台用户数据更新,end","apiLog");
        Yii::info("用户数据展示","apiLog");
        return $this->render('update', [
            'model' => $model,
        ]);

    }
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatebak($id)
    {
        $model = $this->findModel($id);
        $model->delRules('password','required');
//        $model->setRules('password','trim');

        if ($model->load(Yii::$app->request->post()) ) {
            if(Yii::$app->request->post('Member')['password']!= '' ){
                $model->generateAuthKey();
                $model->setPassword(Yii::$app->request->post('password'));
            }
            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
//        var_dump($model->rules());exit;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
