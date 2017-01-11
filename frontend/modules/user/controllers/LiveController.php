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
use common\models\MyLive;

class LiveController extends WebController
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
       /* $this->client = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);*/
        /*
         * 调用直播接口必须要登录
         * */
    }
    //我的直播通道
    public function actionIndex(){
      return $this->render('//user/live_index');

    }
    //我的直播详情
    public function actionView(){
        return $this->render('//user/live_view',["live_id"=>yii::$app->request->get("live_id")]);

    }
}