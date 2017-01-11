<?php
namespace frontend\Libs\Cart;

class Cart
{

    public $driver;
    private $_cart;

    public function __construct(CartInterface $driver)
    {
        $this->driver = $driver;
        $this->_cart = $this->driver->get_cart();
    }

    public function add($data)
    {

        $data['attr'] = $data['attr'] ?: null;
        $this->_cart[] = $data;
        /*

        $good_id = $good;

        if (is_array($good)) {
        $good_id = $good['good_id'];
        }

        if ($num != 0) {
        if (is_array($good)) {
        $result = ($this->_cart[$good_id][$good['attr']] += $num);
        } else {
        $result = ($this->_cart[$good_id] += $num);
        }
        }*/
        $this->driver->set_cart($this->_cart);
    }

    public function del($key)
    {
        unset($this->_cart[$key]);
        $this->driver->set_cart($this->_cart);
    }

    public function onlyOne($goods_id)
    {
        foreach ($this->_cart as $key => $value) {
            if ($value['goods_id'] == $goods_id) {
                return false;
            }
        }
        return true;
    }

    public function dec($good, $num = 1)
    {
        $good_id = $good;
        if (is_array($good)) {
            $good_id = $good['good_id'];
        }

        if (isset($this->_cart[$good_id])) {
            if (is_array($good)) {
                $result = $this->_cart[$good_id][$good['attr']] -= $num;
                if ($this->_cart[$good_id][$good['attr']] < 1) {
                    $result = $this->_cart[$good_id][$good['attr']] = 0;
                    unset($this->_cart[$good_id][$good['attr']]);
                    if (empty($this->_cart[$good_id])) {
                        unset($this->_cart[$good_id]);
                    }
                }
            } else {
                $result = $this->_cart[$good_id] -= $num;
                if ($this->_cart[$good_id] < 1) {
                    $result = $this->_cart[$good_id] = 0;
                    unset($this->_cart[$good_id]);
                }
            }
            $this->driver->set_cart($this->_cart);
        }

        return $result;
    }

    public function clear()
    {
        unset($this->_cart);
        return $this->driver->clear();
    }

    public function get_cart()
    {
        return $this->driver->get_cart();
    }

}
