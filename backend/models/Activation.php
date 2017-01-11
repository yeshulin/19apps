<?php

namespace backend\models;

use backend\models\search\ActivationCatlogSearch;
use backend\models\search\ActivationSearch;
use Yii;

/**
 * This is the model class for table "{{%activation}}".
 *
 * @property integer $activid
 * @property string $activ_code
 * @property string $lot_number
 * @property integer $type
 * @property integer $make_time
 * @property integer $status
 * @property integer $userid
 * @property string $username
 * @property integer $m_userid
 * @property string $m_username
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $product_id
 * @property string $videoplay_id
 * @property integer $m_type
 */
class Activation extends \yii\db\ActiveRecord
{
    public $num=1;//
    public $Ptype='';
    public $year=0;
    public $month=1;
    public $p_type_id=0;//p_type后缀ID
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status', 'userid', 'm_userid', 'start_time', 'product_id', 'videoplay_id', 'm_type','Ptype','effective','year','month'], 'integer'],
            [['activ_code', 'username', 'm_username'], 'string', 'max' => 64],
            [['end_time','make_time'],'safe'],
            [['num'],'integer','min'=>1],
            [['product_id'],'required'],
            [['lot_number'], 'string', 'max' => 10],
        ];
    }
    public function make(){
        Yii::info("激活码创建开始",'apiLog');
        //当前时间
        $now = time();

        //生成批号
        $searchModel=new ActivationSearch();
        $Seacrh = $searchModel->search('');
        $content = $Seacrh->query->limit(1)->orderBy(['lot_number'=>SORT_DESC])->one();
        $now_number="00001";
        if(!empty($content)){
            $now_number=$content->toArray()['lot_number']+1;
        }
        $now_number=sprintf("%05s",$now_number);//格式化批号
        $this->lot_number=$now_number;

        //生成用户Id
        if(empty($this->m_userid)){
            $_user=Yii::$app->user->getIdentity();
            $this->m_userid=$_user->id;
            $this->m_username=$_user->username;
        }

        //商品p_type
        $good = Goods::findOne(['goods_id'=>$this->product_id]);
        $p_type_pre=$good->type;
        $this->p_type = implode("_",[$p_type_pre,$this->p_type_id]);

//        $activeCat = ActivationCatlog::findOne(['id'=>$this->type])->product_id;
//        $this->product_id=$activeCat;

        //有效时长计算
        $this->effective=($this->month+$this->year*12)*30;

        //激活码前缀
        $prefix = "HQ".sprintf("%02d",$this->Ptype);
        //激活码生成
        $this->status=1;
        $this->make_time=$now;
        $this->end_time=is_numeric($this->end_time)?$this->end_time:strtotime($this->end_time);
        Yii::info("激活码创建数据".print_r($this->toArray(),true),'apiLog');
        for($i = 0; $i < $this->num; $i ++) {
            $this->isNewRecord=true;
            $returnStr=$prefix.$this->activation_rand();
            $this->activ_code=$returnStr;
            if(!$this->save()){
                Yii::info("激活码创建失败，第".($i+1)."个",'apiLog');
                Yii::info("激活码创建失败，error:".print_r($this->getErrors(),true),'apiLog');
                $this->addErrors("激活码创建失败,已创建".($i+1)."个");
                return false;
            }
            $this->activid=0;//重置主键，继续插入
            Yii::info("激活码创建成功，第".($i+1)."个",'apiLog');
            Yii::info("激活码创建成功".$returnStr,'apiLog');
        }
        return true;
    }
    public function activation_rand(){ //随机生成激活码函数
        $pattern   = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $returnStr='';
        for($i=0;$i<16;$i++){

            $returnStr .= $pattern {mt_rand ( 0, 61 )}; //生成php随机数
        }
//        $abool=$this->activation_db->get_one(array('activ_code'=>activ_code));
        $abool=Activation::findOne(['activ_code'=>$returnStr]);
        if(!empty($abool)){
            $this->activation_rand();
        }
        Yii::info("激活码生成".$returnStr,'apiLog');
        return $returnStr;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activid' => 'id编号',
            'activ_code' => '激活码',
            'lot_number' => '批号',
            'Ptype' => '商品类型(激活码前缀)',
            'type' => '激活码类型',
            'make_time' => '生成时间',
            'status' => '状态',
            'num'=>'生成数量',
            'userid' => '使用者ID',
            'username' => '使用者用户名',
            'm_userid' => '生成者Id',
            'm_username' => '生成者用户名',
            'start_time' => 'Start Time',
            'end_time' => '激活码有效期',
            'year' => '年',
            'month' => '月',
            'effective' => '有效时长',
            'p_type' => '商品类型_商品id',
            'product_id' => '绑定商品',
            'videoplay_id' => 'Videoplay ID',
            'm_type' => '生成类型',
            "make_time_start"=>"生成时间-开始",
            "make_time_end"=>"到",
            "end_time_start"=>"有效期-开始",
            "end_time_end"=>"到",
        ];
    }
}
