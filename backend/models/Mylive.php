<?php

namespace backend\models;

use Yii;

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
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Mylive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mylive}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['live_name', 'userid', 'status',], 'required'],
            [[ 'userid', 'status', 'created_at'], 'integer'],
            [['live_name'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'live_id' => 'Live_id',
            'goods_id'=>'商品ID',
            'live_name' => '直播名称',
            'userid' => '用户ID',
            'tongdao' => '通道',
            'qiehuan' => '切换台',
            'liuliang' => '流量包',
            'menhu' => '门户',
            'roomid' => '直播间ID',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
