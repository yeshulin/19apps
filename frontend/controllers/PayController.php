<?php
namespace frontend\controllers;

use common\models\Order;
use common\models\OrderPay;
use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class PayController extends WebController
{
    public $enableCsrfValidation = false;

    public function actionNotify()
    {
        $request = Yii::$app->request;
        $method = $request->get('m') ?: 'alipay';
        $param = $request->post();

        $order_info = Order::find()->where(['trade_sn' => $param['out_trade_no']])->asArray()->one();

        if (!$order_info) {
            echo "fail";
            return;
        }

        $pay = new \frontend\Libs\PaySDK\PaySDK();

        $result = $pay->get($method)->notify($param);

        $model = OrderPay::findOne($order_info['payid']);
        if (!$model) {
            return;
        }
        if ($result != 'fail') {
            $model->status = $result;
            $model->method = $method;
            $model->respone_info = serialize($param);
            $model->save();
        }
    }

    public function actionTest()
    {
        return $this->showmessage('成功', Url::to(['/user/order/list']), 'success');
        $cart = new \frontend\Libs\Cart\Cart(new \frontend\Libs\Cart\Cache());
        $cart->clear();
        //$cart->inc(2,5);
        //$cart->inc(['good_id'=>1,'attr'=>'1']);
        var_dump($cart->get_cart());

    }

    public function actionTest1()
    {
        $cart = new \frontend\Libs\Cart\Cart(new \frontend\Libs\Cart\Cache());
        //$cart->inc(2,5);
        //$cart->inc(['good_id'=>1,'attr'=>'1']);
        var_dump($cart->get_cart());

    }
}
