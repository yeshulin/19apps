<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $goods_id
 * @property string $goods_name
 * @property string $keywords
 * @property string $goods_thumb
 * @property string $price
 * @property string $money
 * @property integer $type
 * @property integer $association_id
 * @property integer $selltype
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $subtitle
 */
class Goods extends \yii\db\ActiveRecord
{
   // 商品类型
    const TYPE_COURSE = 1; //视频课程
    const TYPE_LAB = 2; // 实验室
    const TYPE_PRACTICAL = 3; //实训
    const TYPE_LIVE = 4; //直播
    const TYPE_PXCC = 5; //培训课程
    const TYPE_ZYRZ = 6; //职业认证
    const TYPE_MERGE = 8; //组合商品

    //销售类型
    const SELLTYPE_DEFAULT = 0; // 默认
    const SELLTYPE_ADMIN = 1; //后台议价
//    const SELLTYP

    // 商品状态
    const STATUS_DELETE = 0; //删除
    const STATUS_DEFAULT = 1; //正常
    const STATUS_OUT = 2; //下架


    public $goods_merge;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_name', 'keywords', 'goods_thumb', /*'parameter',*/ 'description', 'buyknows', 'money', 'is_new', 'is_hot', 'status', ], 'required'],
            [['goods_merge'],'required','message'=>'组合商品ID不能为空','on'=>'merge'],
            [['price', 'money'], 'number'],
            [['minbuynumber', 'is_new', 'is_hot', 'type', 'association_id', 'order', 'status', 'selltype'], 'integer'],
            [[/*'parameter',*/ 'description', 'buyknows'], 'string'],
            [['goods_name'], 'string', 'max' => 40],
            [['keywords', 'goods_thumb', 'subtitle'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goods_id' => '商品ID',
            'goods_name' => '商品名称',
            'subtitle' => '副标题',
            'keywords' => '关键词',
            'goods_thumb' => '略缩图',
            'price' => '原价',
            'money' => '现价',
            'minbuynumber' => '最小购买数',
//            'parameter' => '产品参数',
            'description' => '产品详情',
            'buyknows' => '购买须知',
            'is_new' => '是否最新',
            'is_hot' => '是否最热',
            'type' => '商品类型',
            'selltype' => '销售类型',
            'association_id' => '商品关联ID',
            'status' => '状态',
            'order'=> '排序',
            'create_at' => '创建时间',
            'update_at' => '修改时间',
            'goods_merge'=> '组合商品ID',
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                self::STATUS_DEFAULT => '正常',
                self::STATUS_OUT => '下架',
                self::STATUS_DELETE => '删除',
            ],
            'type' => [
                self::TYPE_COURSE => '视频课程',
                self::TYPE_LAB => '实验室',
                self::TYPE_PRACTICAL => '实训',
                self::TYPE_LIVE => '直播',
                self::TYPE_PXCC => '培训课程',
                self::TYPE_ZYRZ => '职业认证',
                self::TYPE_MERGE => '组合商品',
            ],
            'selltype' => [
                self::SELLTYPE_DEFAULT => '正常',
                self::SELLTYPE_ADMIN => '后台议价',

            ],
            'is_hot'=>[
                0 => '否',
                1 => '是',
            ],
            'is_new'=>[
                0 => '否',
                1 => '是',
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null) {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        }

        //返回关联数组，用户下拉的filter实现
        else {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }

    /**
     * 获取商品数据
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsAttr()
    {
        return $this->hasMany(GoodsAttr::className(), ['goods_id'=>'goods_id']);
    }

    /**
     * 获取组合商品数据
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsMerge()
    {
        return $this->hasMany(GoodsMerge::className(), ['goods_id'=>'goods_id'])->asArray(true);
    }

}
