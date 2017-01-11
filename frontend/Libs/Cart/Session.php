<?php
namespace frontend\Libs\Cart;

use Yii;

class Session implements CartInterface
{
    private $__session;

    public function __construct()
    {
        $this->__session = Yii::$app->session;
        $this->__session->open();
    }

    public function clear()
    {
        $this->__session->remove('cart');
    }

    public function get_cart()
    {
        return $this->__session->get('cart');
    }

    public function set_cart($data)
    {
        $this->__session->set('cart', $data);
    }

}
