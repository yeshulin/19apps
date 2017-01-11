<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%mypractical}}".
 *
 * @property integer $practical_id
 * @property string $practical_name
 * @property integer $totals
 * @property integer $userid
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $lab_code
 * @property integer $status
 */
class Mypractical extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mypractical}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practical_id'], 'required'],
            [['practical_url'],"url"],
            [['practical_id', 'totals', 'userid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['practical_name', 'practical_code'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'practical_id' => 'Practical ID',
            'practical_name' => '实验室名称',
            'totals' => '购买数量',
            'userid' => '用户id',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'practical_code' => '实验室编码',
            'practical_url' => '链接地址',
            'status' => '状态',
        ];
    }
}
