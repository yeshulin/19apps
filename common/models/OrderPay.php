<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%order_pay}}".
 *
 * @property string $id
 * @property string $request_info
 * @property string $respone_info
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Order[] $orders
 */
class OrderPay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_pay}}';
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
            [['request_info', 'respone_info', 'method'], 'string'],
            [['status'], 'required'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_info' => 'Request Info',
            'respone_info' => 'Respone Info',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasOne(Order::className(), ['payid' => 'id']);
    }
}
