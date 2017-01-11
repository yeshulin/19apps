<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_sections}}".
 *
 * @property integer $sectionid
 * @property string $name
 * @property integer $courseid
 * @property integer $order
 */
class CourseSections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course_sections}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['courseid'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 120],
            [['order'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sectionid' => '章节ID',
            'name' => '章节名称',
            'courseid' => '课程ID',
            'order' => '排序',
        ];
    }

    public static function _delete($model)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $SectionModel = $model->delete();
            $BarsModel = CourseBars::find()->where(['sectionid'=>$model->sectionid])->all();
            $bool = true;
            $knows = 0;
            if ($BarsModel)
            {
                foreach ($BarsModel as $v)
                {
                    $know = CourseKnows::find()->where(['barsid'=>$v->barsid])->count();
                    if (!CourseKnows::deleteAll(['barsid'=>$v->barsid]))
                    {
                        $bool = false;
                        break;
                    } else {
                        $knows += $know;
                    }
                }
                $BarsModel = CourseBars::deleteAll(['sectionid'=>$model->sectionid]);
            }
            else {
                $BarsModel = true;
            }


            if($SectionModel && $BarsModel && $bool)
            {
                $transaction->commit();
                $courseModel = Course::findOne($model->courseid);
                $courseModel->count_knows_num = intval($courseModel->count_knows_num) - intval($knows);
                $courseModel->save();
                return true;
            } else {
                $transaction->rollback();
                return false;
            }
        }  catch(Exception $e) {
            $transaction->rollback();
        }
    }

    /**
     * 获取小节信息
     * @return \yii\db\ActiveQuery
     */
    public function getCourseBars()
    {
        return $this->hasMany(CourseBars::className(), ['sectionid'=> 'sectionid']);
    }

    /**
     * 获取章节信息
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['course_id'=>'courseid']);
    }
}
