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
class MyLive extends \yii\db\ActiveRecord
{

    const STATUS_DEFAULT = 1; //默认状态
    const STATUS_DELETE = 0; //删除状态
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
