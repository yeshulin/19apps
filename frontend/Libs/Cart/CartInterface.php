<?php
namespace frontend\Libs\Cart;

interface CartInterface
{

    public function clear();
    public function set_cart($data);
    public function get_cart();

}