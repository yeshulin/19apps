<?php
namespace frontend\Libs\PaySDK\alipay;

use common\models\Order;
use frontend\Libs\PaySDK\paySDKInterface;
use yii\helpers\Url;
use yii\httpclient\Client;

require_once "alipay_core.function.php";
require_once "alipay_md5.function.php";

class Alipay implements paySDKInterface
{

    public $alipay_config;
    /**
     *支付宝网关地址（新）
     */
    public $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?';

    public function __construct()
    {
        $this->alipay_config = \Yii::$app->params['paysdk']['alipay'];
    }

    public function getPay($info)
    {

        $param = [
            'out_trade_no' => $info['trade_sn'],
            'subject' => '订单号' . $info['trade_sn'],
            'total_fee' => $info['price'],
            'return_url' => $info['return_url'],
        ];

        $para = $this->buildRequestPara(array_merge($this->alipay_config, $param));
        
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$this->alipay_gateway_new."_input_charset=".trim(strtolower($this->alipay_config['input_charset']))."' method='".$method."'>";
        while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml."<input type='submit'  value='".$button_name."' style='display:none;'></form>";
        
        $sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";
        
        return ['param' => $para, 'return' => $sHtml];
    }

    public function notify($param)
    {
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if ($verify_result or 1==1) {
            if ($param['trade_status'] == 'TRADE_FINISHED' || $param['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
                //如果有做过处理，不执行商户的业务程序
                $order = Order::find()->where(['trade_sn' => $param['out_trade_no']])->one();
                if ($order->status == 'unpay' && $order->price == $param['total_fee'] && $this->alipay_config['seller_id'] == $param['seller_id']) {
                    $order->payOK();

                    $client = new Client([
                        'transport' => 'yii\httpclient\CurlTransport',
                    ]);
                    $parArr = [
                        'trade_sn' => $order['trade_sn'],
                    ];
                    $response = $client->createRequest()
                        ->setFormat("json")
                        ->setMethod('post')
                        ->setUrl(\Yii::$app->request->hostInfo.Url::to(['/api/grant/set']))
                        ->setData($parArr)
                        ->send();

                    $re = 'success';
                } else {
                    if ($order->status == 'unpay' && $order->price != $param['total_fee']) {
                        $re = 'price_error';
                    }
                    if ($order->status == 'unpay' && $this->alipay_config['seller_id'] != $param['seller_id']) {
                        $re = 'seller_id_error';
                    }
                }
            }
            echo "success";
            return $re;
        }
        echo "fail";
        return 'fail';
    }

    /**
     * 生成签名结果
     * @param $para_sort 已排序要签名的数组
     * return 签名结果字符串
     */
    public function buildRequestMysign($para_sort)
    {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = createLinkstring($para_sort);

        $mysign = "";
        switch (strtoupper(trim($this->alipay_config['sign_type']))) {
            case "MD5":
                $mysign = md5Sign($prestr, $this->alipay_config['key']);
                break;
            default:
                $mysign = "";
        }

        return $mysign;
    }

    /**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组
     */
    public function buildRequestPara($para_temp)
    {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = argSort($para_filter);

        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort);

        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = strtoupper(trim($this->alipay_config['sign_type']));

        return $para_sort;
    }

    /**
     * 生成要请求给支付宝的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组字符串
     */
    public function buildRequestParaToString($para_temp)
    {
        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);

        //把参数组中所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
        $request_data = createLinkstringUrlencode($para);

        return $request_data;
    }

    /**
     * 建立请求，以表单HTML形式构造（默认）
     * @param $para_temp 请求参数数组
     * @param $method 提交方式。两个值可选：post、get
     * @param $button_name 确认按钮显示文字
     * @return 提交表单HTML文本
     */
    public function buildRequestForm($para_temp, $method, $button_name)
    {
        //待请求参数数组
        $para = $this->buildRequestPara($para_temp);

        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='" . $this->alipay_gateway_new . "_input_charset=" . trim(strtolower($this->alipay_config['input_charset'])) . "' method='" . $method . "'>";
        while (list($key, $val) = each($para)) {
            $sHtml .= "<input type='hidden' name='" . $key . "' value='" . $val . "'/>";
        }

        //submit按钮控件请不要含有name属性
        $sHtml = $sHtml . "<input type='submit'  value='" . $button_name . "' style='display:none;'></form>";

        //$sHtml = $sHtml . "<script>document.forms['alipaysubmit'].submit();</script>";

        return $sHtml;
    }

    /**
     * 用于防钓鱼，调用接口query_timestamp来获取时间戳的处理函数
     * 注意：该功能PHP5环境及以上支持，因此必须服务器、本地电脑中装有支持DOMDocument、SSL的PHP配置环境。建议本地调试时使用PHP开发软件
     * return 时间戳字符串
     */
    public function query_timestamp()
    {
        $url = $this->alipay_gateway_new . "service=query_timestamp&partner=" . trim(strtolower($this->alipay_config['partner'])) . "&_input_charset=" . trim(strtolower($this->alipay_config['input_charset']));
        $encrypt_key = "";

        $doc = new DOMDocument();
        $doc->load($url);
        $itemEncrypt_key = $doc->getElementsByTagName("encrypt_key");
        $encrypt_key = $itemEncrypt_key->item(0)->nodeValue;

        return $encrypt_key;
    }
}
