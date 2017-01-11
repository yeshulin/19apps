<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%message}}".
 *
 * @property string $messageid
 * @property string $send_from_id
 * @property string $send_to_id
 * @property string $folder
 * @property integer $status
 * @property string $message_time
 * @property string $subject
 * @property string $content
 * @property string $replyid
 * @property integer $del_type
 */
class Message extends \yii\db\ActiveRecord
{
    static public $folders=[
        "inbox"=>"收件箱",
        "outbox"=>"发件箱",
        "all"=>"其他"
    ];
    static public $statusArr=[
        0=>'已读',
        1=>'未读'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
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
            [['folder', 'content'], 'string'],
            [['status', 'message_time', 'replyid', 'del_type'], 'integer'],
            [['content'], 'required'],
            [['send_from_id', 'send_to_id'], 'string', 'max' => 30],
            [['subject'], 'string', 'max' => 80],
        ];
    }
    public function add_message($tousername,$username,$subject,$content) {
        $this->send_from_id = $username;
        $this->send_to_id = $tousername;
        $this->subject = $subject;
        $this->content = $content;
        $this->status = 1;
        $this->folder = "inbox";
        return $this->save();
    }
    static public function getStatus($isList=false,$value=''){
        return $isList?self::$statusArr:self::$statusArr[$value];
    }
    static public function getFolder($isList=false,$value=''){
        return $isList?self::$folders:self::$folders[$value];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '消息Id',
            'send_from_id' => '发送人',
            'send_to_id' => '收信人',
            'folder' => '文件夹',
            'status' => '状态',
            'message_time' => 'Message Time',
            'created_at' => '创建时间',
            'subject' => '主题',
            'content' => '内容',
            'replyid' => '回复Id',
            'del_type' => '删除状态',
        ];
    }
}
