<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%mylive}}".
 *
 * @property integer $live_id
 * @property string $live_name
 * @property integer $userid
 * @property string $tongdao
 * @property string $qiehuangtai
 * @property string $liuliangbao
 * @property integer $roomid
 * @property integer $create_at
 * @property integer $update_at
 */
class UseLab extends \yii\db\ActiveRecord
{

    const STATUS_DEFAULT = 1; //默认状态
    const STATUS_DELETE = 0; //过期
    const STATUS_NO = -1;//解除授权
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%uselab}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_code', 'lab_id', 'userid','status'], 'required'],
            [[ 'userid', 'status','lab_id', 'created_at'], 'integer'],
            [['lab_code','username'], 'string', 'max' => 200],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            'id' => 'ID',
            'lab_code'=>'实验室编码',
            'lab_id' => '实验室ID',
            'userid' => '用户ID',
            'username' => '用户名',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                self::STATUS_DEFAULT => '正常',
                self::STATUS_DELETE => '过期',
                self::STATUS_NO => '解除授权',
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
