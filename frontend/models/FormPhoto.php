<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%form_photos}}".
 *
 * @property string $dataid
 * @property string $userid
 * @property string $username
 * @property string $datetime
 * @property string $ip
 * @property string $photo
 * @property string $name
 * @property string $info
 * @property string $looks
 * @property string $indeximg
 * @property string $gkleibie
 * @property string $address
 * @property string $arrdata
 * @property string $status
 */
class FormPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form_photos}}';
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
//            [['userid', 'username', 'datetime', 'ip', 'photo', 'info'], 'required'],
            [['status','college'], 'integer'],
            [['photo', 'info'], 'string'],
//            [['username'], 'string', 'max' => 20],
            [['ip'], 'string', 'max' => 15],
            [['name', 'looks', 'indeximg', 'address'], 'string', 'max' => 255],
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
            'updated_at' => '更新时间',
            'ip' => 'Ip',
            'photo' => '相册',
            'name' => '相册名称',
            'info' => '介绍',
            'looks' => 'Looks',
            'indeximg' => '头图',
            'college' => '所属高校',
            'address' => '地址',
//            'arrdata' => 'Arrdata',
            'status' => '状态',
        ];
    }
}
