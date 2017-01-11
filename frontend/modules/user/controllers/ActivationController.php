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

class ActivationController extends WebController
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
    //激活码页面
    public function actionIndex(){
         return $this->render('//user/activation_index');
    }
    public function actionList(){
        return $this->render('//user/activation_list');
    }

}