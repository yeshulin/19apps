<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%template}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $content
 * @property integer $created_at
 * @property integer $isworking
 * @property integer $updated_at
 * @property integer $userid
 */
class Template extends \yii\db\ActiveRecord
{
    static public $isWorking = [//是否设为默认模板
        0 => "否",
        1 => "是"
    ];
    static public $types = [//模板
        'message' => '消息',
        'email' => '邮件',
    ];
    static public $application = [//模板应用
        'reg' => '用户注册',
        'active' => '用户激活',
        'msg'=>'系统消息发送',
        'password'=>'重置密码',
        'resetemail'=>'邮箱修改',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%template}}';
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
            [['type'], 'string'],
            [['isworking', 'userid'], 'integer'],
            [['content','name'], 'string'],
            [['name'], 'string','max'=>50],
            [['name'], 'required'],
        ];
    }

    static public function getIsWorking($isList = true, $value = '')
    {
        return $isList ? self::$isWorking : self::$isWorking[$value];
    }
    static public function getType($isList = true, $value = '')
    {
        return $isList ? self::$types : self::$types[$value];
    }
    static public function getApplication($isList = true, $value = '')
    {
        return $isList ? self::$application : self::$application[$value];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '模板类型',
            'name' => '模板名称',
            'content' => '模板内容',
            'created_at' => '创建时间',
            'isworking' => '是否运用模板',
//            'updated_at' => 'Updated At',
            'userid' => '创建者',
        ];
    }
}
