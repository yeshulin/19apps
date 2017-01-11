<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%advertisement}}".
 *
 * @property string $id
 * @property string $display_name
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class Advertisement extends \yii\db\ActiveRecord
{
    public $type;

    public $octype;
    public $occontent;
    public $occurl;

    public $ctype;
    public $ccontent;
    public $curl;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%advertisement}}';
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
            [['display_name', 'status', 'content'], 'required'],
            [['status'], 'integer'],
            [['display_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'display_name' => '广告名称',
            'content' => '内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'type' => '广告类型',
        ];
    }

    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            'status' => [
                1 => '正常',
                0 => '禁用',
            ],
            'type' => [
                1 => '图片',
                2 => '文字',
            ],
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

    public function upload($file)
    {
        $validator = new \yii\validators\FileValidator(['extensions' => ['jpg', 'png', 'gif', 'jepg'], 'checkExtensionByMimeType' => false, 'maxSize' => 1024 * 1024 * 1024 * 2]);
        if ($validator->validate($file, $error)) {
            $now = time();
            $basePath = dirname(Yii::$app->basePath) . '/frontend/web/uploads/';
            if (!is_dir($basePath . date('Y', $now))) {
                mkdir($basePath . date('Y', $now), 0777);
            }
            if (!is_dir($basePath . date('Y', $now) . '/' . date('m', $now))) {
                mkdir($basePath . date('Y', $now) . '/' . date('m', $now), 0777);
            }
            $filename = uniqid(md5(microtime(true)));
            $file->saveAs($basePath . date('Y', $now) . '/' . date('m', $now) . '/' . $filename . '.' . $file->extension);
            return 'uploads/' . date('Y', $now) . '/' . date('m', $now) . '/' . $filename. '.' . $file->extension;
        } else {
            return false;
        }
    }
}
