<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_linkage}}".
 *
 * @property integer $courseid
 * @property integer $linkageid
 */
class CourseLinkage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course_linkage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseid', 'linkageid'], 'required'],
            [['courseid', 'linkageid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courseid' => '课程id',
            'linkageid' => '课程配置信息',
        ];
    }
}
