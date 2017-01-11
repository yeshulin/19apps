<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\user\controllers;

use frontend\controllers\WebController;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class OrderController extends WebController
{
    public $layout = "@app/views/layouts/user";
    private $cancelurl;
    public function init()
    {
        parent::init();
        $user = Yii::$app->user->identity;
        if (empty($user)) {
            $this->redirect(['/auth/login']);
        }
        $baseApiUrl = Yii::$app->request->hostInfo;
        $this->cancelurl = $baseApiUrl . Url::to(['/api/order/cancel']);
    }

    public function actionList()
    {
        return $this->render('//user/orderlist');
    }
    public function actionView()
    {
        return $this->render('//user/orderinfo', ['trade_sn' => Yii::$app->request->get('trade_sn')]);
    }

    public function actionCancel()
    {
        $trade_sn = Yii::$app->request->get('trade_sn');

        if ($trade_sn) {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);

            $parArr = [
                'trade_sn' => $trade_sn,
                'userid' => Yii::$app->user->id,
            ];

            $response = $client->createRequest()
                ->setFormat("json")
                ->setMethod('post')
                ->setUrl($this->cancelurl)
                ->setData($parArr)
                ->send();
            if ($response->isOk) {
                $res = $response->data;
                if ($res['code'] == '0000') {
                    $this->redirect(['/user/order/list']);
                } else {
                    return $this->showmessage($res['error']);
                }
            }
        }

    }
}
