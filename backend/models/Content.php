<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property string $id
 * @property integer $catid
 * @property string $title
 * @property string $thumb
 * @property string $keywords
 * @property string $description
 * @property string $url
 * @property integer $order
 * @property integer $status
 * @property string $username
 * @property string $inputtime
 * @property string $updatetime
 * @property integer $videoPath
 * @property integer $content
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catid', 'order', 'status', 'inputtime', 'updatetime', 'videoPath'], 'integer'],
            [['description', 'username'], 'required'],
            [['description','content'], 'string'],
            [['title'], 'string', 'max' => 80],
            [['thumb', 'url'], 'string', 'max' => 100],
            [['keywords'], 'string', 'max' => 40],
            [['username'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '文章ID',
            'catid' => '栏目ID',
            'title' => '标题',
            'thumb' => '缩略图',
            'keywords' => '关键词',
            'description' => '描述',
            'url' => '跳转地址',
            'order' => '排序',
            'status' => '状态',
            'username' => '所属用户',
            'inputtime' => '新建时间',
            'updatetime' => '更新时间',
            'videoPath' => '视频地址',
            'content' => '内容',
        ];
    }
}
