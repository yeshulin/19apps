<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_config_id}}".
 *
 * @property integer $course_id
 * @property integer $course_config_id
 * @property integer $type
 */
class CourseConfigId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course_config_id}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'course_config_id', 'type'], 'required'],
            [['course_id', 'course_config_id', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'course_config_id' => 'Course Config ID',
            'type' => 'Type',
        ];
    }

    public function rewite($config = [], $id)
    {
        $this->deleteAll(['course_id'=>$id]);
        if (empty($config))
        {
            return false;
        }
        foreach ($config as $v)
        {
            $this->isNewRecord = true;
            $this->course_id = $id;
            $CourseConfigModel = CourseConfig::find()->where(['course_config_id'=>$v])->one();
            if ($CourseConfigModel != null)
            {
                $this->course_config_id = $CourseConfigModel->course_config_id;
                $this->type = $CourseConfigModel->type;
//            var_dump($this->type);
                $this->save();
            }

        }
        return true;
    }

    public static function courseConfig($id)
    {
        $data = self::find()->where(['course_id'=>$id])->asArray(true)->all();
        $result = [];
        foreach ($data as $v)
        {
            $result[] = $v['course_config_id'];
        }
        return $result;
    }
}
