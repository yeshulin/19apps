<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/26
 * Time: 16:12
 */

namespace backend\models;
use Yii;
use common\models\Course as ComCourse;

class Course extends ComCourse
{
    public function save($runValidation = true, $attributeNames = null)
    {
        $this->update_at = time();
        if (!$this->create_at) {
            $this->create_at = time();
        }
        $this->authorid = 0;// 默认用户
        $this->userid = Yii::$app->user->id;
//        $this->type = self::TYPE_DEFAULT;
//        $this->status = self::STATUS_DEFAULT;
        if (!$this->auth_count_time)
        {
            $this->auth_count_time = self::AUTH_TIMES * 2592000;
        }
        if (!$this->learnnumber)
        {
            $this->learnnumber = 0;
        }
//        $this->auth_count_time = $this->auth_count_time * 2592000;

        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }
}