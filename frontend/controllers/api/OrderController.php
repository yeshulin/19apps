<?php
namespace frontend\controllers\api;

use common\models\Goods;
use common\models\GoodsAttr;
use common\models\Member;
use common\models\Mycourse;
use common\models\Order;
use common\models\OrderContent;
use common\models\OrderPay;
use frontend\models\FormAddress;
use Yii;
use yii\filters\VerbFilter;

class OrderController extends ApiController
{
    public $response;
    public $userid;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'view' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        /*if ($this->isGuest()) {
        return self::setReturn('0003', 'failed', '', '未登录，请先执行登陆操作！');
        }*/
        $this->userid = Yii::$app->user->id;
    }

    public function actionList()
    {
        $data = Yii::$app->request->get();

        $page = [
            'page' => $data['page'],
            'pagesize' => $data['pagesize'],
        ];

        $result = Order::arrayAll(['userid' => $this->userid], $page);
        if (empty($result)) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
        } else {
            $this->setReturn("0000", "success", $result);
        }
    }

    public function actionView()
    {
        $data = Yii::$app->request->get();
        if (empty($data['trade_sn'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }
        $result = Order::arrayOne(['trade_sn' => $data['trade_sn']]);
        if (empty($result)) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
        } else {
            $this->setReturn("0000", "success", $result);
        }
    }

    public function actionSubmit()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);
        $model = new Order;
        $model->userid = $data['userid'];
        $model->discount = 0.00;
        $model->price = 0.00;
        $model->status = 'unpay';
        $model->trade_sn = $trade_sn = $this->_create_sn();
        $model->remarks = $data['remarks'];

        if (empty($data['userid'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $username = Member::find()->select(['id', 'username', 'usertype'])->where(['id' => $model->userid])->one();
        if ($username) {
            $model->username = $username['username'];
            $usertype = $username['usertype'];
        } else {
            $this->setReturn("0003", "failed", "", "找不到用户");
            return;
        }

        if (!empty($data['addressid'])) {
            $address = FormAddress::find()->where(['id' => $data['addressid'], 'userid' => $data['userid']])->asArray()->one();
            if (!$address) {
                $this->setReturn("0003", "failed", "", "地址信息错误");
                return;
            }
            $model->contactname = $address['contact'];
            $model->phone = $address['mobile'];
            $model->address = serialize($address);
        }

        if (!empty($data['goods'])) {
            $model->type = 0;
            $i = 1;
            foreach ($data['goods'] as $key => $value) {
                $good = Goods::find()->where(['goods_id' => $value['id']])->asArray()->one();
                if ($i == 1) {
                    $model->type = $good['selltype'];
                }
                if ($i > 1 && $model->type != $good['selltype']) {
                    $this->setReturn("0003", "failed", "", "同一订单商品销售类型必须一致");
                    return;
                }

                if ($good) {
                    if ($good['type'] == 1) {
                        $hasCourse = Mycourse::find()->where(['userid' => $model->userid, 'courseid' => $good['association_id']])->count();
                        if ($hasCourse > 0) {
                            $this->setReturn("0003", "failed", "", "课程不能重复购买");
                            return;
                        }
                    }
                    if ($good['type'] == 2 && $usertype != 3) {
                        $this->setReturn("0003", "failed", "", "实验室仅供教育认证用户购买");
                        return;
                    }

                    if ($good['type'] == 3 && $usertype != 2) {
                        $this->setReturn("0003", "failed", "", "实训仅供企业认证用户购买");
                        return;
                    }

                    if ($good['type'] == 4 && $usertype < 1) {
                        $this->setReturn("0003", "failed", "", "直播仅供认证用户购买");
                        return;
                    }
                    if ($data['goods'][$key]['num'] < $good['minbuynumber']) {
                        $data['goods'][$key]['num'] = $good['minbuynumber'];
                    }
                    if (!empty($value['attrs'])) {
                        if ($good['type'] == 4) {
                            $attrs_price = 1;
                        } else {
                            $attrs_price = 0;
                        }
                        foreach ($value['attrs'] as $k => $vo) {
                            $attr = GoodsAttr::find()->where(['goods_id' => $good['goods_id'], 'uniquekey' => $vo['uniquekey']])->asArray()->one();
                            if ($attr) {
                                $data['goods'][$key]['attrs_info'][$k] = $attr;
                                $data['goods'][$key]['attrs_info'][$k]['num'] = $vo['num'];
                                if ($good['type'] == 4) {
                                    $attrs_price *= ($attr['money'] * $vo['num']);
                                } else {
                                    $attrs_price += ($attr['money'] * $vo['num']);
                                }
                            } else {
                                $this->setReturn("0003", "failed", "", "属性信息错误");
                                return;
                            }
                        }
                        $data['goods'][$key]['price'] = $attrs_price * $data['goods'][$key]['num'];
                    } else {
                        $data['goods'][$key]['price'] = $good['money'];
                    }
                    $data['goods'][$key]['num'] = $data['goods'][$key]['num'];
                    $data['goods'][$key]['goods_info'] = $good;
                } else {
                    $this->setReturn("0003", "failed", "", "商品信息错误");
                    unset($data['goods'][$key]);
                    return;
                }
                if ($model->type == 0) {
                    $model->price += ($data['goods'][$key]['price'] * $data['goods'][$key]['num']);
                }
                //$i++;
            }
        }

        if (empty($data['goods'])) {
            $this->setReturn("0003", "failed", "", "商品不能为空");
            return;
        }

        $op = new OrderPay();
        $op->status = 'unpay';
        $op->save();
        $model->payid = $op->id;

        if ($model->save()) {
            $orderid = $model->id;
            foreach ($data['goods'] as $key => $value) {
                $ocModel = new OrderContent();
                $ocModel->order_id = $orderid;
                $ocModel->goods_id = $value['id'];
                if (!empty($value['attrs_info'])) {
                    $value['goods_info']['attrs'] = $value['attrs_info'];
                }
                $ocModel->goods_info = serialize($value['goods_info']);
                $ocModel->price = $value['price'];
                $ocModel->num = $value['num'];
                $ocModel->save();
            }
            $this->setReturn("0000", "success", ['id' => $orderid, 'trade_sn' => $trade_sn, 'type' => $model->type]);
        } else {
            $op->delete();
            $this->setReturn("0003", "failed", "", $model->getFirstErrors());
        }

    }

    public function actionCancel()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);

        if (empty($data['trade_sn']) || empty($data['userid'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $id = Order::find()->select('id')->where(['trade_sn' => $data['trade_sn'], 'userid' => $data['userid']])->asArray()->one();

        if (!$id) {
            $this->setReturn("0003", "failed", "", '没有找到订单');
            return;
        }

        $model = new Order();
        if ($model->setStatus($id['id'], 'cancel')) {
            $this->setReturn("0000", "success", "");
        } else {
            $this->setReturn("0003", "failed", "", $model->getFirstErrors());
        }

    }

    public function actionPay()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);

        if (empty($data['trade_sn']) || empty($data['return_url'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $method = $data['method'] ?: 'alipay';

        $pay = new \frontend\Libs\PaySDK\PaySDK();

        $order_info = Order::find()->where(['trade_sn' => $data['trade_sn']])->asArray()->one();

        if (!$order_info) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
            return;
        }

        if ($order_info['status'] != 'unpay') {
            $this->setReturn("0003", "failed", "", "订单状态错误");
            return;
        }

        if ($order_info['type'] != '0') {
            $this->setReturn("0003", "failed", "", "议价订单不能支付");
            return;
        }

        if ($order_info['price'] == 0) {
            $this->setReturn("0003", "failed", "", "0元订单不能发起支付");
            return;
        }

        $order_info['return_url'] = $data['return_url'];

        $result = $pay->get($method)->getPay($order_info);

        $model = OrderPay::findOne($order_info['payid']);
        if (!$model) {
            $this->setReturn("0003", "failed", "", "支付信息错误");
            return;
        }
        $model->method = $method;
        $model->request_info = serialize($result['param']);
        $model->save();

        $this->setReturn("0000", "success", $result['return']);

    }

    public function actionPaystatus()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);

        if (empty($data['trade_sn'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $order_info = Order::find()->select(['payid', 'status'])->where(['trade_sn' => $data['trade_sn']])->asArray()->one();
        if (!$order_info) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
            return;
        }
        if ($order_info['status'] == 'success') {
            $this->setReturn("0000", "success", ["code" => 0, "msg" => "success"]);
            return;
        } else {
            $payinfo = OrderPay::find()->select(['status'])->where(['id' => $order_info['payid']])->asArray()->one();
            if (!$payinfo) {
                $this->setReturn("0003", "failed", "", "支付信息不全");
                return;
            }
            $this->setReturn("0000", "success", ["code" => -1, "msg" => $payinfo['status']]);
        }
    }

    public function actionPayok()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);

        if (empty($data['trade_sn'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $order_info = Order::find()->where(['trade_sn' => $data['trade_sn']])->asArray()->one();
        if (!$order_info) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
            return;
        }
        if ($order_info['status'] != 'unpay') {
            $this->setReturn("0003", "failed", "", "订单状态错误");
            return;
        }
        $payinfo = OrderPay::findOne($order_info['payid']);
        if ($payinfo['status'] != 'unpay') {
            $this->setReturn("0003", "failed", "", "订单状态错误");
            return;
        }

        $model = new Order;
        $model->setStatus($order_info['id'], 'success');

        $payinfo->status = 'success';
        $payinfo->save();
        $this->setReturn("0000", "success", ["code" => 0, "msg" => "success"]);
    }

    public function actionHascourse()
    {
        $data = json_decode(Yii::$app->request->rawBody, true);

        if (empty($data['userid']) || empty($data['courseid'])) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $hasCourse = Mycourse::find()->where(['userid'=>$data['userid'],'courseid'=>$data['courseid']])->count();

        $this->setReturn("0000", "success", [$hasCourse]);
    }

    private function _create_sn()
    {
        mt_srand((double) microtime() * 1000000);
        return date("YmdHis") . str_pad(mt_rand(1, 99999), 5, "0", STR_PAD_LEFT);
    }

}
