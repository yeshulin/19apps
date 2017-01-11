<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\user\controllers;

use common\models\UsePractical;
use Yii;
use frontend\controllers\WebController;
use yii\httpclient\Client;
use yii\helpers\Url;
use common\models\MyPractical;
use common\models\Goods;
use backend\models\Activation;

class PracticalController extends WebController
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
       /* $parArr = [
            'loginname'=>$this->user['username']
        ];
        $response = $this->client->createRequest()
            ->setMethod('post')
            ->setUrl(yii::$app->params["api"]["vboss"]."/desktops/getDesktoplistPublic2")
            ->setData($parArr)
            ->send();
        if($response->isOk){
            $practicaldesktops = $response->data['data'];
            //云工厂使用链接
            $ygcurl = \common\helpers\Encrypt::yungongchang(['use_url'=>yii::$app->params['api']['ygc']],$this->user);
        }*/
        /*
         * 获取云互动实验室使用
         * */
       /* $response = $this->client->createRequest()
            ->setFormat("json")
            ->setMethod('post')
            ->setUrl(yii::$app->params["api"]["college"]."api/use-practical/list")
            ->setData(['status'=>1])
            ->send();
        $practicalwangjie = array();
        //
        $mypractical = new MyPractical();
        if($response->isOk){
            foreach($response->data["data"]['data'] as $key=>$val){
                $mypracticalinfo = $mypractical::find()
                    ->where(['practical_id'=>$val['practical_id']])
                    ->one();
                $practicalwangjie[$key]['practical_name'] = $mypracticalinfo['practical_name'];
                $practicalwangjie[$key]['begin_time'] = $mypracticalinfo['end_time'];
                $practicalwangjie[$key]['practica_url'] = $mypracticalinfo['practical_url'];
                $goods = new goods();
                $goodsinfo = $goods::find()
                    ->where(['goods_id'=>$mypracticalinfo['goods_id']])
                    ->one();
                $practicalwangjie[$key]['goods_thumb'] = $goodsinfo['goods_thumb'];
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
            $practicaldesktops = $response->data['data'];
            //云工厂使用链接
            $ygcurl = \common\helpers\Encrypt::yungongchang(['use_url'=>yii::$app->params['api']['ygc']],$this->user);
        }*/
        /*
         * 管理云桌面
         * */
        /*
        * 管理云桌面
        * */
        $mypractical = new MyPractical();
        $lablist = $mypractical::find()
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
        //return $this->render('//user/practical_index',["practicaldescktops"=>$practicaldesktops,"ygcurl"=>$ygcurl,"practicalwangjie"=>$practicalwangjie,"practicallist"=>$lablist]);
        return $this->render('//user/practical_index',["practicallist"=>$lablist]);
    }
    /*
  * setgrant
  * 查看激活用户列表
  * */
    public function actionSetgrant(){
        $practical_id = yii::$app->request->get("practical_id");
        $usepractical = new UsePractical();
        $uselist = $usepractical::find()
            ->where(['practical_id'=>$practical_id,'status'=>1])
            ->asArray()
            ->all();
        return $this->render("//user/lab_setgrant",['uselist'=>$uselist,'practical_name'=>yii::$app->request->get("practical_name")]);
    }
    /*
     * 取消用户授权
     * */
    public function actionDelgrant(){
        $id = yii::$app->request->get("id");
        $usepractical = new UsePractical();
        $usepractical->id = $id;
        $usepractical->status = 0;
        if($usepractical->save()){
            $this->redirect(Url::to(["/user/lab/setgrant",'practical_id'=>yii::$app->request->get("practical_id"),"practical_name"=>yii::$app->request->get("practical_name")]));
        }
    }
}