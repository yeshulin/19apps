<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%sms}}".
 *
 * @property string $id
 * @property string $mobile
 * @property string $posttime
 * @property string $id_code
 * @property string $msg
 * @property string $send_userid
 * @property integer $status
 * @property string $return_id
 * @property string $ip
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mobile', 'id_code', 'msg', 'return_id', 'ip'], 'required'],
            [['posttime', 'send_userid', 'status'], 'integer'],
            [['mobile'], 'string', 'max' => 11],
//            [['id_code'], 'string', 'max' => 10],
//            [['msg'], 'string', 'max' => 90],
//            [['return_id'], 'string', 'max' => 30],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile' => 'Mobile',
            'posttime' => 'Posttime',
            'id_code' => 'Id Code',
            'msg' => 'Msg',
            'send_userid' => 'Send Userid',
            'status' => 'Status',
            'return_id' => 'Return ID',
            'ip' => 'Ip',
        ];
    }
}
