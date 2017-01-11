<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%form_collection}}".
 *
 * @property string $dataid
 * @property string $userid
 * @property string $username
 * @property string $datetime
 * @property string $ip
 * @property string $rz_head_img
 * @property string $zskvideo
 * @property string $name
 * @property string $info
 * @property string $looks
 * @property string $spbq
 * @property integer $looknum
 * @property string $rz_content_img
 * @property integer $goodcomment
 * @property integer $videoimgstatus
 */
class FormCollection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_collection}}';
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
//            [['userid', 'username', 'datetime', 'ip', 'info', 'rz_content_img', 'goodcomment'], 'required'],
            [['looknum', 'goodcomment', 'status','college'], 'integer'],
            [['info'], 'string'],
//            [['username'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 15],
            [['rz_head_img', 'zskvideo', 'name', 'looks'], 'string', 'max' => 255],
            [['rz_content_img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Dataid',
//            'userid' => 'Userid',
//            'username' => 'Username',
            'created_at' => '创建时间',
            'updated_at' => '更改时间',
            'ip' => 'Ip',
            'rz_head_img' => '封面',
            'zskvideo' => 'VmsId',
            'name' => '名称',
            'info' => '介绍',
            'looks' => 'Looks',
            'college' => '所属高校',
            'looknum' => '浏览次数',
            'rz_content_img' => '作品内容',
            'goodcomment' => '好评数',
            'status' => '状态',
        ];
    }
}
