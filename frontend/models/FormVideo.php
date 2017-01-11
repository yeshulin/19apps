<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%form_videos}}".
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
class FormVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_videos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['userid', 'username', 'datetime', 'ip', 'info', 'rz_content_img', 'goodcomment'], 'required'],
            [['userid', 'looknum', 'goodcomment', 'videoimgstatus'], 'integer'],
            [['info'], 'string'],
            [['username'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 15],
            [['rz_head_img', 'zskvideo', 'name', 'looks', 'spbq'], 'string', 'max' => 255],
            [['rz_content_img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dataid' => 'Dataid',
            'userid' => 'Userid',
            'username' => 'Username',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'ip' => 'Ip',
            'rz_head_img' => 'Rz Head Img',
            'zskvideo' => 'Zskvideo',
            'name' => 'Name',
            'info' => 'Info',
            'looks' => 'Looks',
            'spbq' => 'Spbq',
            'looknum' => 'Looknum',
            'rz_content_img' => 'Rz Content Img',
            'goodcomment' => 'Goodcomment',
            'videoimgstatus' => 'Videoimgstatus',
        ];
    }
}
