<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%content_catlog}}".
 *
 * @property integer $catid
 * @property string $catname
 * @property integer $pid
 */
class ContentCatlog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_catlog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['catid'], 'required'],
            [ ['pid'], 'integer'],
            [['catname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'catid' => '栏目id',
            'catname' => '栏目名称',
            'pid' => '父级栏目id',
        ];
    }
}
