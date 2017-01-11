<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_content}}".
 *
 * @property string $id
 * @property string $order_id
 * @property string $goods_id
 * @property string $goods_info
 *
 * @property Order $order
 * @property Goods $goods
 */
class OrderContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'goods_id', 'goods_info', 'num', 'price'], 'required'],
            [['order_id', 'goods_id', 'num'], 'integer'],
            [['goods_info', 'attrs_info'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'goods_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'goods_id' => 'Goods ID',
            'goods_info' => 'Goods Info',
            'goods_info' => 'Goods Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['goods_id' => 'goods_id']);
    }
}
