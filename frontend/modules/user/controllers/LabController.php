<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\user\controllers;

use common\models\UseLab;
use Yii;
use frontend\controllers\WebController;
use yii\httpclient\Client;
use yii\helpers\Url;
use common\models\MyLab;
use common\models\Goods;
use backend\models\Activation;

class LabController extends WebController
{
    public $user;
    public $client;
    public $layout="@app/views/layouts/user";
    public function init()
    {
        parent::init();
        $this->user=Yii::$app->user->identity;
        if(empty($this->user)){
            $this->redirect(['/auth/login']);
        }
        $this->client = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
    }

    public function actionIndex()
    {
        //获取用户独占桌面权限
        /*$parArr = [
            'loginname'=>$this->user['username']
        ];
        $response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl(yii::$app->params["api"]["vboss"]."/desktops/getDesktoplistPublic2")
            ->setData($parArr)
            ->send();
        if($response->isOk){
            $labdesktops = $response->data['data'];
            //云工厂使用链接
            $ygcurl = \common\helpers\Encrypt::yungongchang(['use_url'=>yii::$app->params['api']['ygc']],$this->user);
        }*/
        /*
         * 获取云互动实验室使用
         * */
       /* $response = $this->client->createRequest()
            ->setFormat("json")
            ->setMethod('post')
            ->setUrl(yii::$app->params["api"]["college"]."api/use-lab/list")
            ->setData(['status'=>1])
            ->send();
        $labwangjie = array();
        //
        $mylab = new MyLab();
        if($response->isOk){
           foreach($response->data["data"]['data'] as $key=>$val){
                $mylabinfo = $mylab::find()
                    ->where(['lab_id'=>$val['lab_id']])
                    ->one();
               $labwangjie[$key]['lab_name'] = $mylabinfo['lab_name'];
               $labwangjie[$key]['begin_time'] = $mylabinfo['end_time'];
               $labwangjie[$key]['lab_url'] = $mylabinfo['lab_url'];
               $goods = new goods();
               $goodsinfo = $goods::find()
                   ->where(['goods_id'=>$mylabinfo['goods_id']])
                   ->one();
               $labwangjie[$key]['goods_thumb'] = $goodsinfo['goods_thumb'];
           }
        }*/
        /*
         * 获取用户网界桌面权限
         * */
        /*$response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl(yii::$app->params["api"]["vboss"]."/desktops/getDesktoplistPersonal")
            ->setData($parArr)
            ->send();
        if($response->isOk){
            $labdesktops = $response->data['data'];
            //云工厂使用链接
            $ygcurl = \common\helpers\Encrypt::yungongchang(['use_url'=>yii::$app->params['api']['ygc']],$this->user);
        }*/
        /*
         * 管理云桌面
         * */
        $mylab = new MyLab();
        $lablist = $mylab::find()
                    ->where(["userid"=>$this->user->id])
                    ->asArray()
                    ->all();
        //激活码查询
        $activation = new Activation();
        foreach($lablist as $key=>$val){
            $actinfo = $activation::find()
                       ->where(['m_userid'=>$this->user->id,'product_id'=>$val['goods_id']])
                       ->asArray()
                       ->all();
            $lablist[$key]['actinfo'] = $actinfo;
        }
        //return $this->render('//user/lab_index',["labdescktops"=>$labdesktops,"ygcurl"=>$ygcurl,"labwangjie"=>$labwangjie,"lablist"=>$lablist]);
        return $this->render('//user/lab_index',["lablist"=>$lablist]);
    }
    /*
     * setgrant
     * 查看激活用户列表
     * */
    public function actionSetgrant(){
        $lab_id = yii::$app->request->get("lab_id");
        $uselab = new UseLab();
        $uselist = $uselab::find()
            ->where(['lab_id'=>$lab_id,'status'=>1])
            ->asArray()
            ->all();
        return $this->render("//user/lab_setgrant",['uselist'=>$uselist,'lab_name'=>yii::$app->request->get("lab_name")]);
    }
    /*
     * 取消用户授权
     * */
    public function actionDelgrant(){
        $id = yii::$app->request->get("id");
        $uselab = UseLab::findOne($id);
        $uselab->id = $id;
        $uselab->status = 0;
        if($uselab->save()){
            $this->redirect(Url::to(["/user/lab/setgrant",'lab_id'=>yii::$app->request->get("lab_id"),"lab_name"=>yii::$app->request->get("lab_name")]));
        }
    }
}