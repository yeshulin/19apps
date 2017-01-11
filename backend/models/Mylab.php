<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%mylab}}".
 *
 * @property integer $lab_id
 * @property string $lab_name
 * @property integer $totals
 * @property integer $userid
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $lab_code
 * @property integer $status
 */
class Mylab extends \yii\db\ActiveRecord
{
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
            [['lab_id'], 'required'],
            [['lab_url'],"url"],
            [['lab_id', 'totals', 'userid', 'created_at', 'updated_at', 'status'], 'integer'],
            [['lab_name', 'lab_code'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lab_id' => '实验室ID',
            'lab_name' => '实验室名称',
            'totals' => '购买数量',
            'userid' => '用户ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'lab_code' => '实验室编码',
            'lab_url' => '链接地址',
            'status' => '状态',
        ];
    }
}
