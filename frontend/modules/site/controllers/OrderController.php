<?php

namespace frontend\modules\site\controllers;

use frontend\controllers\WebController;
use frontend\models\FormAddress;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class OrderController extends WebController
{
    private $goodurl;
    private $submiturl;
    private $payurl;
    private $orderviewurl;
    private $paystatusurl;
    private $request;
    private $cart;
    private $granturl;
    private $payokurl;

    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $baseApiUrl = Yii::$app->request->hostInfo;
        $this->goodurl = $baseApiUrl . Url::to(['/api/goods']);
        $this->submiturl = $baseApiUrl . Url::to(['/api/order/submit']);
        $this->payurl = $baseApiUrl . Url::to(['/api/order/pay']);
        $this->paystatusurl = $baseApiUrl . Url::to(['/api/order/paystatus']);
        $this->orderviewurl = $baseApiUrl . Url::to(['/api/order/view']);
        $this->granturl = $baseApiUrl . Url::to(['/api/grant/set']);
        $this->payokurl = $baseApiUrl . Url::to(['/api/order/payok']);
        $this->cart = new \frontend\Libs\Cart\Cart(new \frontend\Libs\Cart\Cache());

    }

    //购物车
    public function actionCart()
    {
        $cart = $this->cart->get_cart();
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        //从购物车读取商品ID，并拼装获取商品信息的请求
        if (empty($cart)) {
            return $this->showmessage('购物车为空');
        }
        foreach ($cart as $key => $value) {
            $requests[$key] = $client->post($this->goodurl, ['method' => 'all', 'type' => 'view', 'id' => $value['goods_id']]);
        }
        if (!empty($requests)) {
            $responses = $client->batchSend($requests);
            //从返回的商品信息中拼装购物车商品列表
            foreach ($responses as $key => $value) {
                if ($value->isOk) {
                    if ($value->data['code'] == "0000") {
                        $data = $value->data['data'];
                        if (!empty($cart[$key]['attr'])) {
                            foreach ($data['goodsAttr'] as $k => $vo) {
                                foreach ($cart[$key]['attr'] as $k1 => $vo1) {
                                    if ($k1 == $vo['uniquekey']) {
                                        $data['goodsAttr'][$k]['num'] = $vo1;
                                    }
                                }
                            }
                        }
                        $data['num'] = $cart[$key]['num'];
                        $data['cartkey'] = $key;
                        /*if (is_array($cart[$key])) {
                        foreach ($data['goodsAttr'] as $k => $vo) {
                        foreach ($cart[$key] as $k1 => $vo1) {
                        if ($k1 == $vo['uniquekey']) {
                        $data['goodsAttr'][$k]['num'] = $vo1;
                        }
                        }
                        }
                        } else {
                        unset($data['goodsAttr']);
                        }*/
                        $goods[] = $data;
                    }
                }
            }
        }

        return $this->render("//order/cart", ['goods' => $goods]);
    }

    //确认订单
    public function actionConfirm()
    {
        if (Yii::$app->request->isPost) {
            $user = Yii::$app->user->identity;
            if (empty($user)) {
                $this->redirect(['/auth/login']);
            }
            $data = Yii::$app->request->post();
            $usertype = $user->usertype;
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            if ($user['regStatus'] == 3) {
                return $this->showmessage('验证邮箱激活账户后才能购物');
            }
            //获取提交的商品ID，并拼装获取商品信息的请求
            foreach ($data['goods'] as $key => $value) {
                $requests[$key] = $client->post($this->goodurl, ['method' => 'all', 'type' => 'view', 'id' => $value['goods_id']]);
            }
            if (!empty($requests)) {
                $responses = $client->batchSend($requests);
                //从返回的商品信息中拼装商品列表
                $i = 1;
                $selltype = 0;
                foreach ($responses as $key => $value) {
                    if ($value->isOk) {
                        if ($value->data['code'] == "0000") {
                            $resdata = $value->data['data'];

                            if ($i == 1) {
                                $selltype = $resdata['selltype'];
                            }
                            if ($i > 1 && $selltype != $resdata['selltype']) {
                                return $this->showmessage("同一订单商品销售类型必须一致");
                            }

                            if ($resdata['type'] == 2 && $usertype != 3) {
                                return $this->showmessage("实验室仅供教育认证用户购买");
                            }

                            if ($resdata['type'] == 3 && $usertype != 2) {
                                return $this->showmessage("实训仅供企业认证用户购买");
                            }

                            if ($resdata['type'] == 4 && $usertype < 1) {
                                return $this->showmessage("直播仅供认证用户购买");
                            }

                            if ($data['goods'][$key]['num'] < $resdata['minbuynumber']) {
                                $data['goods'][$key]['num'] = $resdata['minbuynumber'];
                            }
                            if (!empty($data['goods'][$key]['attr'])) {
                                foreach ($resdata['goodsAttr'] as $k => $vo) {
                                    foreach ($data['goods'][$key]['attr'] as $k1 => $vo1) {
                                        if ($vo['uniquekey'] == $vo1) {
                                            $resdata['goodsAttr'][$k]['num'] = $data['goods'][$key][$vo1] ?: 1;
                                        }
                                    }
                                }
                            } else {
                                unset($resdata['goodsAttr']);
                            }
                            $resdata['num'] = $data['goods'][$key]['num'];
                            $goods[] = $resdata;
                            $i++;
                        }
                    }
                }
            } else {
                return $this->showmessage('没有商品提交');
            }
            $address = FormAddress::find()->where(['userid' => Yii::$app->user->id])->orderBy(['status' => SORT_DESC])->asArray()->all();

            return $this->render("//order/confirm", ['goods' => $goods, 'address' => $address, 'selltype' => $selltype, 'isCart' => $data['isCart'] ?: 0]);
        }
    }

    //提交订单
    public function actionSubmit()
    {
        if (Yii::$app->request->isPost) {
            $user = Yii::$app->user->identity;
            if (empty($user)) {
                $this->redirect(['/auth/login']);
            }
            $data = Yii::$app->request->post();
            //var_dump($data);exit();
            foreach ($data['goods'] as $key => $value) {
                $goods[$key]['id'] = $value['goods_id'];
                if (!empty($value['attr'])) {
                    foreach ($value['attr'] as $k => $vo) {
                        $goods[$key]['attrs'][$k]['uniquekey'] = $vo;
                        $goods[$key]['attrs'][$k]['num'] = $value[$vo];
                    }
                }
                $goods[$key]['num'] = $value['num'];
            }
            if (!empty($goods)) {

                $client = new Client([
                    'transport' => 'yii\httpclient\CurlTransport',
                ]);
                $parArr = [
                    'userid' => Yii::$app->user->id,
                    'addressid' => $data['addressid'],
                    'goods' => $goods,
                    'remarks' => $data['remarks'],
                ];
                $response = $client->createRequest()
                    ->setFormat("json")
                    ->setMethod('post')
                    ->setUrl($this->submiturl)
                    ->setData($parArr)
                    ->send();

                if ($response->isOk) {
                    $res = $response->data;
                    if ($res['code'] == '0000') {
                        if ($data['isCart']) {
                            $this->cart->clear();
                        }
                        if ($res['data']['type'] == 0) {
                            $this->redirect(['/site/order/pay', 'trade_sn' => $res['data']['trade_sn']]);
                        } else {
                            $this->redirect(['/user/order/list']);
                        }
                    } else {
                        return $this->showmessage($res['error']);
                    }
                }
            } else {
                return $this->showmessage("没有商品提交");
            }
        }
    }

    //订单支付
    public function actionPay()
    {
        $user = Yii::$app->user->identity;
        if (empty($user)) {
            $this->redirect(['/auth/login']);
        }
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        $baseApiUrl = Yii::$app->params['staticUrl'];
        if (Yii::$app->request->isPost) {
            $method = Yii::$app->request->post('method') ?: 'alipay';
            $parArr = [
                'trade_sn' => Yii::$app->request->post('trade_sn'),
                'return_url' => $baseApiUrl . Url::to(['/site/order/payreturn']),
                'method' => $method,

            ];
            $response = $client->createRequest()
                ->setFormat("json")
                ->setMethod('post')
                ->setUrl($this->payurl)
                ->setData($parArr)
                ->send();

            if ($response->isOk) {
                $res = $response->data;
                if ($res['code'] == '0000') {
                    if ($method == 'alipay') {
                        echo $res['data'];
                    }
                } else {
                    return $this->showmessage($res['error']);
                }
            }
        } else {
            $parArr = [
                'trade_sn' => Yii::$app->request->get('trade_sn'),
            ];
            $response = $client->createRequest()
                ->setMethod('get')
                ->setUrl($this->orderviewurl)
                ->setData($parArr)
                ->send();
            if ($response->isOk) {
                $res = $response->data;
                if ($res['code'] == '0000') {
                    if ($res['data']['userid'] == Yii::$app->user->id) {
                        if ($res['data']['status'] == 'unpay') {
                            if ($res['data']['price'] == 0) {
                                if ($res['data']['type'] == 0) {

                                    $payokres = $client->createRequest()
                                        ->setFormat("json")
                                        ->setMethod('post')
                                        ->setUrl($this->payokurl)
                                        ->setData(['trade_sn' => $res['data']['trade_sn']])
                                        ->send();

                                    if ($payokres->isOk) {
                                        if ($payokres->data['code'] == '0000') {
                                            $grantres = $client->createRequest()
                                                ->setFormat("json")
                                                ->setMethod('post')
                                                ->setUrl($this->granturl)
                                                ->setData(['trade_sn' => $res['data']['trade_sn']])
                                                ->send();
                                            return $this->showmessage('支付成功', Url::to(['/user/order/list']), 'success');
                                        } else {
                                            return $this->showmessage($payokres->data['error']);
                                        }
                                    }
                                } else {
                                    return $this->showmessage("议价订单不能支付");
                                }

                            } else {
                                return $this->showmessage('支付功能尚未开通，请等待订单审核。', Url::to(['/user/order/list']));
                                return $this->render("//order/pay", ['order' => $res['data']]);
                            }
                        } else {
                            return $this->showmessage("订单状态错误");
                        }
                    } else {
                        return $this->showmessage("非自己订单");
                    }
                } else {
                    return $this->showmessage($res['error']);
                }
            }
        }
    }

    public function actionPayreturn()
    {
        $trade_sn = Yii::$app->request->get('out_trade_no');
        if ($trade_sn) {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $parArr = [
                'trade_sn' => $trade_sn,
            ];
            $response = $client->createRequest()
                ->setFormat("json")
                ->setMethod('post')
                ->setUrl($this->paystatusurl)
                ->setData($parArr)
                ->send();

            if ($response->isOk) {
                $res = $response->data;
                if ($res['code'] == '0000') {
                    if ($res['data']['code'] == 0) {
                        return $this->showmessage('支付成功', Url::to(['/user/order/list']), 'success');
                    } else {
                        return $this->render("//order/payreturn", ['statusurl' => $this->paystatusurl, 'trade_sn' => $trade_sn]);
                    }
                } else {
                    return $this->showmessage($res['error']);
                }
            }
        }
    }

    public function actionCartin()
    {
        $this->enableCsrfValidation = false;
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            if (!empty($data)) {
                foreach ($data['goods'] as $key => $value) {

                    $client = new Client([
                        'transport' => 'yii\httpclient\CurlTransport',
                    ]);
                    $parArr = [
                        'id' => $value['goods_id'],
                        'type' => 'view',
                    ];
                    $goodsres = $client->createRequest()
                        ->setMethod('post')
                        ->setUrl($this->goodurl)
                        ->setData($parArr)
                        ->send();
                    if ($goodsres->isOk) {
                        $res = $goodsres->data;
                        if ($res['code'] == '0000') {
                            if ($res['data']['type'] == 1) {
                                if (!$this->cart->onlyOne($value['goods_id'])) {
                                    $response->data = ['status' => 0, 'msg' => '同一门课程只能添加一次'];
                                    return;
                                }
                                $value['num'] == 1;
                            }
                        } else {
                            $response->data = ['status' => 0, 'msg' => '没有找到该商品'];
                            return;
                        }
                    }

                    if (!empty($value['attr'])) {
                        foreach ($value['attr'] as $k => $vo) {
                            $attr[$vo] = $value[$vo];
                        }
                    }
                    $data = ['goods_id' => $value['goods_id'], 'num' => $value['num'], 'attr' => $attr];
                    $this->cart->add($data);
                }
                $response->data = ['status' => 1, 'msg' => 'ok'];
            } else {
                $response->data = ['status' => 0, 'msg' => '数据错误'];
            }
        } else {
            $response->data = ['status' => 0, 'msg' => '请使用POST请求'];
        }
    }

    public function actionCartdel()
    {
        $this->enableCsrfValidation = false;
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            if (!empty($data)) {
                $this->cart->del($data['cartkey']);
                $response->data = ['status' => 1, 'msg' => 'ok'];
            } else {
                $response->data = ['status' => 0, 'msg' => '数据错误'];
            }
        } else {
            $response->data = ['status' => 0, 'msg' => '请使用POST请求'];
        }
    }

}
