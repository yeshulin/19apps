<?php
namespace common\helpers;

/**
 * Created by PhpStorm.
 * User: sobey
 * Date: 2016/8/4
 * Time: 11:24
 */
use Yii;

class Encrypt
{
    static public function sys_auth($string, $operation = 'ENCODE', $key = '', $expiry = 0)
    {
        $key_length = 4;
        $key = md5($key != '' ? $key : Yii::$app->params['auth_key']);
        $fixedkey = md5($key);
        $egiskeys = md5(substr($fixedkey, 16, 16));
        $runtokey = $key_length ? ($operation == 'ENCODE' ? substr(md5(microtime(true)), -$key_length) : substr($string, 0, $key_length)) : '';
        $keys = md5(substr($runtokey, 0, 16) . substr($fixedkey, 0, 16) . substr($runtokey, 16) . substr($fixedkey, 16));
        $string = $operation == 'ENCODE' ? sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $egiskeys), 0, 16) . $string : base64_decode(substr($string, $key_length));

        $i = 0;
        $result = '';
        $string_length = strlen($string);
        for ($i = 0; $i < $string_length; $i++) {
            $result .= chr(ord($string{$i}) ^ ord($keys{$i % 32}));
        }
        if ($operation == 'ENCODE') {
            return $runtokey . str_replace('=', '', base64_encode($result));
        } else {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $egiskeys), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        }
    }

    /**
     * 将字符串转换为数组
     *
     * @param    string $data 字符串
     * @return    array    返回数组格式，如果，data为空，则返回空数组
     */
    static public function string2array($data)
    {
		$array=[];
		$data=stripslashes($data);
        if ($data == '') return array();
        @eval("\$array = $data;");
        return $array;
    }

    /**
     * 将数组转换为字符串
     *
     * @param    array $data 数组
     * @param    bool $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
     * @return    string    返回字符串，如果，data为空，则返回空
     */
    static public function array2string($data, $isformdata = 1)
    {
        if ($data == '') return '';
        if ($isformdata) $data = self::new_stripslashes($data);
        return addslashes(var_export($data, TRUE));
    }
    static public function new_addslashes($string){
        if(!is_array($string)) return addslashes($string);
        foreach($string as $key => $val) $string[$key] = self::new_addslashes($val);
        return $string;
    }
    static public function new_stripslashes($string) {
        if(!is_array($string)) return stripslashes($string);
        foreach($string as $key => $val) $string[$key] = self::new_stripslashes($val);
        return $string;
    }
    static public function yungongchang($param = [],$user){
        if (isset($user['username'])&&!empty($user['username'])){
            return $param['use_url'].'index.php?r=api/login&username='.$user['username'].'&sign='.md5('ygcsobey'.$user['username'].gmdate('Y-m-d'));
        }else{
            return $param['use_url'];
        }
        //md5("ygcsobey".$username.gmdate("Y-m-d"));
    }
}