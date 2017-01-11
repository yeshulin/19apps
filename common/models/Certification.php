<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%certification}}".
 *
 * @property string $certificationid
 * @property string $certification_name
 * @property string $examtype
 * @property string $studyway
 * @property string $object
 * @property string $brief
 * @property string $people
 * @property integer $order
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 */
class Certification extends \yii\db\ActiveRecord
{
    const STATUS_DEFAULT = 1; //正常
    const STATUS_DELETE = 0; //删除

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%certification}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['certification_name', 'examtype', 'studyway', 'object', 'status'], 'required'],
            [['brief', 'people'], 'string'],
            [['order', 'status', 'create_at', 'update_at'], 'integer'],
            [['certification_name', 'examtype', 'studyway', 'object'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'certificationid' => '认证ID',
            'certification_name' => '名称',
            'examtype' => '考试形式',
            'studyway' => '学习方式',
            'object' => '适用对象',
            'brief' => '简介',
            'people' => '适用人群',
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
