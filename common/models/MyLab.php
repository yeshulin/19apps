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
class MyLab extends \yii\db\ActiveRecord
{

    const STATUS_DEFAULT = 1; //默认状态
    const STATUS_DELETE = 0; //删除状态
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mylab}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lab_name', 'userid', 'totals'], 'required'],
            [[ 'userid', 'status','goods_id', 'created_at'], 'integer'],
            [['lab_name'], 'string', 'max' => 200],
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
            'lab_id' => 'Lab_id',
            'goods_id'=>'商品ID',
            'lab_name' => '实验室名称',
            'userid' => '用户ID',
            'totals' => '购买数量',
            'lab_code' => '实验室编码',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'lab_url' => '实验室链接',
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
}
