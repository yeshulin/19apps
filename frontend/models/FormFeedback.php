<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%form_feedback}}".
 *
 * @property string $dataid
 * @property string $userid
 * @property string $username
 * @property string $datetime
 * @property string $ip
 * @property string $leibie
 * @property string $goods_name
 * @property string $yjleibie
 * @property string $content
 * @property string $status
 */
class FormFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_feedback}}';
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
//            [['userid', 'username', 'datetime', 'ip', 'content'], 'required'],
            [['userid'], 'integer'],
            [['content'], 'string'],
            [['content'], 'required'],
            [['username'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 15],
            [['leibie', 'goods_name', 'yjleibie', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Dataid',
            'userid' => '用户id',
            'username' => '用户名',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'ip' => 'Ip',
            'leibie' => 'Leibie',
            'goods_name' => '反馈对象',
            'yjleibie' => 'Yjleibie',
            'content' => '内容',
            'status' => '状态',
        ];
    }
}
