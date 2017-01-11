<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%form_address}}".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $address
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class FormAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_address}}';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid'], 'required'],
            [['userid', 'status','mobile'], 'integer'],
            [['address','remark'], 'string', 'max' => 255],
            [['contact','linkage'], 'string', 'max' => 50],
            [['username'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户id',
            'address' => '地址',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
