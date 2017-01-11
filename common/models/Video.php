<?php

namespace common\models;

use common\components\Vms;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\caching\FileCache;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $videoid
 * @property string $vmsid
 * @property string $videoname
 * @property integer $time
 * @property string $thumb
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $userid
 * @property integer $usertype
 * @property integer $type
 * @property integer $status
 * @property integer $order
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_DEFAULT = 0; //默认状态
    const STATUS_CHECK = 1; //待审核


    const TYPE_COURSE = 11; //课程视频
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vmsid', 'videoname', 'time', 'thumb', 'create_at', 'update_at', 'userid', 'usertype', 'type', 'status'], 'required'],
            [['time', 'create_at', 'update_at', 'userid', 'usertype', 'type', 'status', 'order'], 'integer'],
            [['vmsid', 'videoname', 'thumb'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'videoid' => 'Videoid',
            'vmsid' => '视频在vms中的id',
            'videoname' => '视频名称',
            'time' => '时长',
            'thumb' => '缩略图',
            'create_at' => '添加时间',
            'update_at' => '更新时间',
            'userid' => '用户id',
            'usertype' => 'Usertype',
            'type' => '所属栏目',
            'status' => '状态',
            'order' => '排序',
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ],
            ],
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $type = (new FileCache()) ->get('VmsCatalogListCache');
        if (!$type)
        {
            $type = (new Vms())->getCatalogList();
            (new FileCache())->set('VmsCatalogListCache',$type);
        }
        $dropDownList = [
            'status' => [
                self::STATUS_DEFAULT => '正常',
                self::STATUS_CHECK => '待审核',
            ],
            'type' => $type,
        ];
        //根据具体值显示对应的值
        if ($value !== null) {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        }

        //返回关联数组，用户下拉的filter实现
        else {
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }
}
