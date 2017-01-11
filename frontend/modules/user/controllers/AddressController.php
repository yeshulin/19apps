<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 * 我的直播
 */

namespace frontend\modules\user\controllers;

use Yii;
use frontend\controllers\WebController;
use yii\httpclient\Client;
use yii\helpers\Url;

class AddressController extends WebController
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
    //我的收货地址列表
    public function actionIndex(){
         return $this->render('//user/myaddress_index');
    }
    /*
     * 我的收货详情
     * */
    public function actionView(){
        return $this->render("//user/myaddress_view",['id'=>Yii::$app->request->get("id")]);
    }
    /*
     * 添加收货地址
     * */
    public function actionAdd(){
        return $this->render("//user/myaddress_add");
    }
}