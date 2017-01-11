<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%lab}}".
 *
 * @property string $labid
 * @property string $lab_name
 * @property string $brief
 * @property integer $type
 * @property string $lab_code
 * @property string $link
 * @property integer $order
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Lab extends \yii\db\ActiveRecord
{
    const TYPE_WJ = 'wangjie';// 网界
    const TYPE_DESKTOP = 'desktop'; //桌面

    const STATUS_DEFAULT = 1; //默认状态
    const STATUS_DELETE = 0; //删除状态
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lab}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_name', 'brief', 'type', 'link','thumb', 'order', 'status', 'lab_code'], 'required'],
            [['lab_name' , 'lab_code'], 'unique'],
            [[ 'order', 'status', 'create_at', 'update_at'], 'integer'],
            [['type','lab_name'], 'string', 'max' => 50],
            [['brief', 'link', 'thumb'], 'string', 'max' => 255],
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
            'labid' => 'Labid',
            'lab_name' => '名称',
            'brief' => '简介',
            'type' => '实验室类型',
            'lab_code' => '实验室编码',
            'thumb' => '缩略图',
            'link' => '关联信息',
            'order' => '排序',
            'status' => '状态',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                self::STATUS_DEFAULT => '正常',
                self::STATUS_DELETE => '删除',
            ],
            'type' => [
                self::TYPE_WJ => '网界',
                self::TYPE_DESKTOP => '桌面',
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
}
