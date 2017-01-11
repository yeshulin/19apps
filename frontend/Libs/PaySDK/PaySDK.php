<?php
namespace frontend\Libs\PaySDK;

use yii\base\Object;

class PaySDK extends Object
{
    public $container;

    public $pay;

    private $_method = [
        'alipay' => 'frontend\Libs\PaySDK\alipay\Alipay',
    ];

    public function __construct()
    {
        $this->container = new \yii\di\Container;

        foreach ($this->_method as $key => $value) {
            $this->container->setSingleton($key, $value);
        }

    }

    public function get($method)
    {
        return $this->container->get($method);
    }

}
