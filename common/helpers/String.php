<?php
namespace common\helpers;

/**
 * Created by PhpStorm.
 * User: sobey
 * Date: 2016/8/18
 * Time: 21:20
 */
use Yii;

class String
{
    static private $info=[
        'id',
        'username','realname','headimg','usertype','email','nickname','mobile','postcode','linkage','address','introduce','sex',
        'remark','created_at','lastdate','regip','lastip','updated_at',
        'loginnum','from','connectid'
    ];
    static public function arrayFilterMember($arr){
        if($arr['regStatus']==1){//手机注册未填邮箱
            $arr['email']="";
        }else if($arr['regStatus'] == 2 || $arr['regStatus'] == 3){
            $arr['mobile']="";
        }
        foreach($arr as $k => $val){
            if(!in_array($k,self::$info)){
                unset($arr[$k]);
            }
        }
        return $arr;
    }
}