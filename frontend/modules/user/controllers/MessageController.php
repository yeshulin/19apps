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

class MessageController extends WebController
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
    //系统消息
    public function actionIndex(){
         return $this->render('//user/message_index');
    }
    /*
    * 我的系统消息
    * */
    public function actionView(){
        return $this->render("//user/message_view",['id'=>Yii::$app->request->get("id")]);
    }
}