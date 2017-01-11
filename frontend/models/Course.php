<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/26
 * Time: 16:13
 */

namespace frontend\models;

use Yii;
use common\models\Course as ComCourse;

class Course extends ComCourse
{
    public $pagesize;

    public $page;

//    public function rules()
//    {
////        return [
////            [['course_name', 'brief'], 'required'],
////            [['description'], 'string'],
////            [['course_name'], 'string', 'max' => 40],
////            [['brief'], 'string', 'max' => 255],
////            [['thumb'], 'string', 'max' => 100],
////        ];
//    }

    /**
     * 检查用户播放权限
     * @param $course_id
     * @return int 200 正常 201未购买该课程 202课程正在重审核 203 课程已删除 204未找到课程 205未到播放权限开始时间 206播放权限已结束
     */
    public static function playAuth($course_id)
    {
        $model = self::findOne($course_id);
        if ($model !== null)
        {
            if ($model->status == self::STATUS_DELETE)
            {
                return 203;
            }
            elseif ($model->status == self::STATUS_CHECK)
            {
                return 202;
            }
            else {
                if ($model->userid == Yii::$app->user->id)
                {
                    return 200;
                }
                if (($myCourseModel = Mycourse::find()->where(['courseid'=> $model->course_id, 'userid'=> Yii::$app->user->id])->one()) !== null)
                {
                    if ($myCourseModel->auth_start_at < time())
                    {
                        if (!$myCourseModel->auth_end_at || $myCourseModel->auth_end_at > time())
                        {
                            return 200;
                        }
                        else {
                            return 206;
                        }
                    }
                    else {
                        return 205;
                    }
                }
                else {
                    return 201;
                }
            }
        }

        return 204;
    }

    public function _save($runValidation = true, $attributeNames = null)
    {
        return parent::save($runValidation, $attributeNames);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->update_at = time();
        if (!$this->create_at) {
            $this->create_at = time();
        }
        $this->authorid = Yii::$app->user->id;// 默认用户
        $this->userid = Yii::$app->user->id;
        $this->type = self::TYPE_DEFAULT;
        $this->status = self::STATUS_CHECK;

        if(!$this->validate()){
            return false;
        }
        return parent::save($runValidation, $attributeNames);
    }

    public function delete()
    {
        return parent::delete();
    }

    public function search($params)
    {
        $this->pagesize = isset($params['pagesize']) ? intval($params['pagesize']) : 10;
        $this->page = isset($params['page']) ? intval($params['page']) : 1;

        $query = self::find()->where(['status'=>self::STATUS_DEFAULT]);

        $totalCount = $query->count();
        $this->page = $this->page > 0 ? $this->page : 1;
        $this->pagesize = $this->pagesize > 0 ? $this->pagesize : 1;
        if ($this->pagesize > 20)
        {
            $this->pagesize = 20;
        }
        $pages = ceil($totalCount/$this->pagesize);
        if ($this->page > $pages) {
            $this->page = $pages;
        }
        return [
            'data'=>$query->offset(($this->page -1) * $this->pagesize)->limit($this->pagesize)->asArray(true)->all(),
            'total'=>$totalCount,
            'currentPage'=>$this->page,
            'pageSize'=>$this->pagesize
        ];
    }
}