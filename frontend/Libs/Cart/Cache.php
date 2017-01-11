<?php
namespace frontend\Libs\Cart;

use Yii;

class Cache implements CartInterface
{
    private $_cache;
    private $_name;

    public function __construct()
    {
        $this->_name = 'cart_'.$_COOKIE['advanced-frontend'];
        $this->_cache = Yii::$app->cache;
    }

    public function clear()
    {
        $this->_cache->delete($this->_name);
    }

    public function get_cart()
    {
        return $this->_cache->get($this->_name);
    }

    public function set_cart($data)
    {
        if($this->_cache->set($this->_name, $data)==false){
            $this->_cache->add($this->_name, $data);
        }
    }

}
