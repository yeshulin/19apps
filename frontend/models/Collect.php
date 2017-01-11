<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%collect}}".
 *
 * @property string $collect_id
 * @property integer $type
 * @property integer $linkid
 * @property integer $goods_id
 * @property integer $userid
 * @property integer $create_at
 * @property integer $update_at
 */
class Collect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collect}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'linkid', 'userid'], 'required'],
            [['type', 'linkid', 'goods_id', 'create_at', 'update_at', 'userid'], 'integer'],
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

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'type' => Goods::dropDown('type'),
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'collect_id' => 'Collect ID',
            'userid' => 'Userid',
            'type' => 'Type',
            'linkid' => 'Linkid',
            'goods_id' => 'Goods_id',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
