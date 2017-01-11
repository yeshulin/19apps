<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%live}}".
 *
 * @property string $liveid
 * @property string $live_name
 * @property string $brief
 * @property string $thumb
 * @property string $overview
 * @property string $flow
 * @property string $scene
 * @property integer $order
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Live extends \yii\db\ActiveRecord
{
    const STATUS_DEFAULT = 1; //默认状态
    const STATUS_DELETE = 0; //删除状态

//    const TYPE_CLASS = 'class'; //直播教室
//    const TYPE_SCHOOL = 'school'; //直播校园
//    const TYPE_PLATFORM = 'platform'; //直播平台
    const TYPE_TD = 'tongdao'; //通道
    const TYPE_LL = 'liuliang';  // 流量包
    const TYPE_QH = 'qiehuan';  // 切换台
    const TYPE_MH = 'menhu';  // 门户

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%live}}';
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                self::STATUS_DEFAULT => '正常',
                self::STATUS_DELETE => '删除',
            ],
            'type' => [
                self::TYPE_TD => '通道',
                self::TYPE_LL => '流量包',
                self::TYPE_QH => '切换台',
                self::TYPE_MH => '门户',
//                self::TYPE_CLASS => '直播教室',
//                self::TYPE_SCHOOL => '直播校园',
//                self::TYPE_PLATFORM => '直播平台',
            ],
        ];
        //根据具体值显示对应的值
        if ($value !== null) {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        } //返回关联数组，用户下拉的filter实现
        else {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['live_name', 'brief', 'thumb', 'overview', 'flow', 'scene', 'order', 'type', 'status'], 'required'],
            [['live_name'], 'unique'],
            [['overview', 'flow', 'scene'], 'string'],
            [['order', 'status', 'create_at', 'update_at'], 'integer'],
            [['live_name', 'type'], 'string', 'max' => 50],
            [['brief', 'thumb'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'liveid' => '直播ID',
            'live_name' => '名称',
            'brief' => '简介',
            'thumb' => '图片',
            'overview' => '产品概述',
            'flow' => '功能流程',
            'scene' => '应用场景',
            'order' => '排序',
            'type' => '类型',
            'status' => '状态',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
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
}
