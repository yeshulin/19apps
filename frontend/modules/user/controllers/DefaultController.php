<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\user\controllers;

use Yii;
use frontend\controllers\WebController;
use yii\httpclient\Client;
use yii\helpers\Url;

class DefaultController extends WebController
{
    private $url;
    public $layout="@app/views/layouts/user";
    public function init()
    {
        parent::init();
        $this->url=$this->apicollege.Url::to(["/api/content/get-content"]);
        $user=Yii::$app->user->identity;
        if(empty($user)){
            $this->redirect(['/auth/login']);
        }
    }

    public function actionIndex()
    {
//        var_dump($response);
//        exit;
        return $this->render('//user/index');
//        return $this->redirect(['show', 'username' => \Yii::$app->user->identity->username]);
    }

    public function actionMycourse()
    {
//        var_dump($response);
//        exit;
        return $this->render('//user/course/mycourse');
//        return $this->redirect(['show', 'username' => \Yii::$app->user->identity->username]);
    }
}