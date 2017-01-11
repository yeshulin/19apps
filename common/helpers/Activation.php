<?php
namespace common\helpers;
/*
 *  激活码生成
 * */
use backend\models\ActivationCatlog;
use Yii;
class Activation {
    static private $return=[
        "code"=>"0000",
        "msg"=>"success",
    ];
    /**
     * 发送消息
     * option
     * @type    激活码类型
     * @num    激活码数量
     * @effective    有效时长(天数)
     * @end_time    激活码有效期（时间戳）
     */
    // Activation::make(8,3,30,time()+3600);
    static public function make($type='',$num='',$effective='',$end_time='') {
        $return = self::$return;
        $activation = new \backend\models\Activation();
        if(!ActivationCatlog::findOne(['id'=>$type])){
            $return["code"]="0003";
            $return["msg"]="failed";
            $return["error"]="无效的激活码类型";
            return $return;
        }
        $activation->type=$type;
        $activation->num=$num;
        $activation->effective=$effective;
        $activation->end_time=$end_time;
        $Ptype = (new \yii\db\Query())->select(['co_goods.type'])
            ->from('co_activation_cat')
            ->innerJoin('co_goods', 'co_goods.goods_id = co_activation_cat.product_id')
            ->where(['co_activation_cat.id' => $type])
            ->one();
        if(empty($Ptype)){
            $return["code"]="0003";
            $return["msg"]="failed";
            $return["error"]="激活码类型未关联到商品";
            return $return;
        }
        $activation->Ptype=$Ptype['type'];
        if($activation->make()){
            return $return;
        }else{
            $return["code"]="0003";
            $return["msg"]="failed";
            $return["error"]=$activation->getErrors();
            return $return;
        }
    }
    //获取激活码分类
    static public function getList(){
        $return =self::$return;
        $cats = ActivationCatlog::find()->all();
        if(empty($cats)){
            $return["code"]="0002";
            $return["msg"]="failed";
            $return["error"]="没有创建激活码类型";
            return $return;
        }
        $data='';
        foreach($cats as $k=>$cat){
            $data[]=$cat->toArray();
        }
        $return['data']=$data;
        return $return;
    }
}
?>