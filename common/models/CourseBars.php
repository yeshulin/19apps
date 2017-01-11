<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%course_bars}}".
 *
 * @property integer $barsid
 * @property string $name
 * @property integer $sectionid
 * @property integer $order
 */
class CourseBars extends \yii\db\ActiveRecord
{
    public $courseid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course_bars}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sectionid'], 'integer'],
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
            'barsid' => '小节ID',
            'name' => '小节名称',
            'sectionid' => '章节ID',
            'order' => '排序',
        ];
    }

    /**
     * 同步删除知识点
     * @param $model
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function _delete($model)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $BarsModel = $model->delete();
            $CourseKnows = true;
            $knows = 0;
            if ((CourseKnows::find()->where(['barsid'=>$model->barsid])->one()) !== null) {
                $knows = CourseKnows::find()->where(['barsid'=>$model->barsid])->count();
                $CourseKnows = CourseKnows::deleteAll(['barsid'=>$model->barsid]);
            }

            if($BarsModel && $CourseKnows)
            {
                $transaction->commit();
                $courseModel = Course::findOne($model->courseSections->courseid);
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
     * 获取关联的知识点信息
     * @return \yii\db\ActiveQuery
     */
    public function getCourseKnows()
    {
        return $this->hasMany(CourseKnows::className(), ['barsid'=> 'barsid']);
    }

    /**
     * 获取章节信息
     * @return \yii\db\ActiveQuery
     */
    public function getCourseSections()
    {
        return $this->hasOne(CourseSections::className(), ['sectionid'=>'sectionid']);
    }

}
