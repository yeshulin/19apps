<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/7/26
 * Time: 14:48
 */

namespace frontend\controllers\api;

use common\models\CourseBars;
use common\models\CourseKnows;
use common\models\CourseSections;
use frontend\models\Course;
use frontend\models\Goods;
use Yii;
use yii\filters\VerbFilter;

class CourseManageController extends ApiController
{
    public $courseInfo;
    public $courseSectionsInfo;
    public $courseBarsInfo;
    public $courseKnowsInfo;
    public $course_id;

    public $api = ['list', 'create', 'update', 'delete', 'view', 'catalog', 'sections', 'bars', 'knows'];

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['POST'],
                ],
            ],
        ];
    }
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if ($this->isGuest())
        {
            return self::setReturn('0003', 'failed', '', '未登录，请先执行登陆操作！');
        }
    }

    public function actionIndex()
    {
        if (Yii::$app->user->identity->usertype == 0) {
            return self::setReturn('0003','你的账号没有此操作权限');
        }
        $params = $this->rawBody;
        $type = isset($params['method']) ? strtolower((string) $params['method']) : 'list';
        if (!in_array($type, $this->api)) {
            return self::setReturn('0003','未找到请求的方法');
        }
        $action = '_'.$type;
        return $this->$action($params);
    }

    /**
     * 我的发布课程列表
     * @return mixed
     */
    protected function _list($params)
    {
        $courseModel = new Course();
        $pagesize = isset($params['pagesize']) ? intval($params['pagesize']) : 10;
        $page = isset($params['page']) ? intval($params['page']) : 1;

        $query = self::find()->where(['userid'=>Yii::$app->user->id]);

        $totalCount = $query->count();
        $page = $page > 0 ? $page : 1;
        $pagesize = $pagesize > 0 ? $pagesize : 1;
        if ($pagesize > 20)
        {
            $pagesize = 20;
        }
        $pages = ceil($totalCount/$pagesize);
        if ($page > $pages) {
            $page = $pages;
        }
        $courseData =  [
            'data'=>$query->offset(($page -1) * $pagesize)->limit($pagesize)->asArray(true)->all(),
            'total'=>$totalCount,
            'currentPage'=>$page,
            'pageSize'=>$pagesize
        ];
        return self::setReturn('0000', 'success',$courseData);
    }


    /**
     * 创建课程
     * @param $params
     * @return mixed
     */
    protected function _create($params)
    {
        $model = new Course();
        if ($model->load($params)) {
            if ($model::find()->where(['course_name'=>$model->course_name])->one() !== null)
            {
                return self::setReturn('0002', 'failed', '','课程名称已经存在无法添加');
            }

            if ($model->save())
            {
                return self::setReturn('0000', 'success','课程添加成功');
            }
            $error = $model->getErrors();
            return self::setReturn('0002', 'failed', '',$error[key($error)][0]);
        }
        else {
            return self::setReturn('0002', 'failed', '','添加课程出错');
        }
    }

    /**
     * 修改课程
     * @param $params
     * @return mixed
     */
    protected function _update($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($this->checkCourseId($id)){
            unset($params['id']);
            $model = $this->courseInfo;
            if ($model->load($params)) {
                if (Course::find()->where(['course_name'=>$model->course_name])->andWhere("course_id != $id")->one() !== null)
                {
                    return self::setReturn('0002', 'failed', '','课程名称已经存在无法更新');
                }
                if ($model->save())
                {
                    return self::setReturn('0000', 'success', '课程更新成功');
                }

                $error = $model->getErrors();
                return self::setReturn('0002', 'failed', '',$error[key($error)][0]);
            }
            else {
                return self::setReturn('0002', 'failed', '','添加更新出错');
            }
        }
    }

    /**
     * 获取课程目录列表
     * @param $params
     * @return mixed
     */
    protected function _catalog($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($this->checkCourseId($id))
        {
            return  self::setReturn('0000', 'success', Course::getCourseSections($id));
        }
    }


    /**
     * 课程章节添加，修改，删除
     * @param $params
     * @return mixed
     */
    protected function _sections($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($params['type'] == 'update' || $params['type'] == 'delete')
        {
            if ($this->checkCourseSectionId($id))
            {
                if ($params['type'] == 'update')
                {
                    if ($this->courseSectionsInfo->load($params))
                    {
                        if (!$this->courseSectionsInfo->validate())
                        {
                            $error = $this->courseSectionsInfo->getErrors();
                            return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                        }
                        if ($this->courseSectionsInfo->save())
                        {
                            return self::setReturn('0000', 'success','更新章节成功');
                        }
                        else {
                            return self::setReturn('0002', 'failed', '','更新章节出错');
                        }
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','更新章节出错');
                    }
                }
                else {
                    if (CourseSections::_delete($this->courseSectionsInfo))
                    {
                        return self::setReturn('0000', 'success','删除章节成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','删除章节失败');
                    }
                }
            }
        }
        else {
            if ($this->checkCourseId($id))
            {
                $model = new CourseSections();
                $model->courseid = $id;
                if ($model->load($params))
                {
                    if (!$model->validate())
                    {
                        $error = $model->getErrors();
                        return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                    }
                    if ($model->save())
                    {
                        return self::setReturn('0000', 'success','章节添加成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','章节添加出错');
                    }
                }
                else {
                    return self::setReturn('0002', 'failed', '','章节添加出错');
                }
            }
        }
    }

    /**
     * 课程小节添加、修改、删除
     * @param $params
     * @return mixed
     */
    protected function _bars($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($params['type'] == 'update' || $params['type'] == 'delete')
        {
            if ($this->checkCourseBarsId($id))
            {
                if ($params['type'] == 'update')
                {
                    if ($this->courseBarsInfo->load($params))
                    {
                        if (!$this->courseBarsInfo->validate())
                        {
                            $error = $this->courseBarsInfo->getErrors();
                            return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                        }
                        if ($this->courseBarsInfo->save())
                        {
                            return self::setReturn('0000', 'success','更新小节成功');
                        }
                        else {
                            return self::setReturn('0002', 'failed', '','更新小节出错');
                        }
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','更新小节出错');
                    }
                }
                else {
                    if (CourseBars::_delete($this->courseBarsInfo))
                    {
                        return self::setReturn('0000', 'success','删除小节成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','删除小节失败');
                    }
                }
            }
        }
        else {
            if ($this->checkCourseSectionId($id))
            {
                $model = new CourseBars();
                $model->sectionid = $id;
                if ($model->load($params))
                {
                    if (!$model->validate())
                    {
                        $error = $model->getErrors();
                        return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                    }
                    if ($model->save())
                    {
                        return self::setReturn('0000', 'success','小节添加成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','小节添加出错');
                    }
                }
                else {
                    return self::setReturn('0002', 'failed', '','小节添加出错');
                }
            }
        }
    }

    /**
     * 课程知识点添加、修改、删除
     * @param $params
     * @return mixed
     */
    protected function _knows($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($params['type'] == 'update' || $params['type'] == 'delete')
        {
            if ($this->checkCourseKnowsId($id))
            {
                if ($params['type'] == 'update')
                {
                    if ($this->courseKnowsInfo->load($params))
                    {
                        if (!$this->courseKnowsInfo->validate())
                        {
                            $error = $this->courseKnowsInfo->getErrors();
                            return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                        }
                        if ($this->courseKnowsInfo->save())
                        {
                            return self::setReturn('0000', 'success','更新知识点成功');
                        }
                        else {
                            return self::setReturn('0002', 'failed', '','更新知识点出错');
                        }
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','更新知识点出错');
                    }
                }
                else {
                    if ( $this->courseKnowsInfo->delete())
                    {
                        return self::setReturn('0000', 'success','删除知识点成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','删除知识点失败');
                    }
                }
            }
        }
        else {
            if ($this->checkCourseBarsId($id))
            {
                $model = new CourseKnows();
                $model->barsid = $id;
                if ($model->load($params))
                {
                    if (!$model->validate())
                    {
                        $error = $model->getErrors();
                        return self::setReturn('0002', 'failed', '', $error[key($error)][0]);
                    }
                    if ($model->save())
                    {
                        return self::setReturn('0000', 'success','知识点添加成功');
                    }
                    else {
                        return self::setReturn('0002', 'failed', '','知识点添加出错');
                    }
                }
                else {
                    return self::setReturn('0002', 'failed', '','知识点添加出错');
                }
            }
        }
    }

//    protected function _view($params)
//    {
//        $id = $params['id'] ? intval($params['id']) : null;
//        if ($this->checkCourseId($id)) {
//            return self::setReturn('0000', $this->courseInfo);
//        }
//    }

    /**
     * 删除课程
     * @param $params
     * @return mixed
     */
    protected function _delete($params)
    {
        $id = $params['id'] ? intval($params['id']) : null;
        if ($this->checkCourseId($id)) {
            if (Goods::find()->where(['association_id'=>$this->course_id,'type'=> Goods::TYPE_COURSE])->one() == null)
            {
                $model = $this->courseInfo;
                if ($model->delete()) {
                    return self::setReturn('0000', 'success', '删除成功');
                } else {
                    return self::setReturn('0002', 'failed', '', '删除失败');
                }
            }
            else {
                return self::setReturn('0002', 'failed', '', '该课程以生成相应商品，请先删除相应商品，在执行');
            }
        }
    }

    /**
     * 检查课程的操作权限
     * @param null $id
     * @return bool
     */
    protected function checkCourseId($id = null)
    {
        if (is_null($id))
        {
            self::setReturn('0002', 'failed', '', '缺少课程ID');
            return false;
        }
        $info = Course::find()->where(['course_id'=>$id, 'userid'=> Yii::$app->user->id])->one();
        if ($info == null)
        {
            self::setReturn('0002', 'failed', '','没有此课程的权限操作');
            return false;
        }
        elseif ($info['status'] == Course::STATUS_DELETE)
        {
            self::setReturn('0002', 'failed', '','课程已发布，无法修改');
            return false;
        }
        else if ($info !== null)
        {
            $this->courseInfo = $info;
            $this->course_id = $id;
            return true;
        }
        else{
            self::setReturn('0003','系统未知错误');
            return false;
        }
    }

    /**
     * 根据章节ID检查课程权限
     * @param null $id
     * @return bool
     */
    protected function checkCourseSectionId($id = null)
    {
        if (is_null($id))
        {
            self::setReturn('0002', 'failed', '', '缺少章节ID');
            return false;
        }
        $SectionModel = CourseSections::findOne($id);
        if ($SectionModel == null)
        {
            self::setReturn('0002', 'failed', '','未找到该章节信息');
            return false;
        }
        else {
            $this->courseSectionsInfo = $SectionModel;
            return $this->checkCourseId($SectionModel->course_id);
        }
    }

    /**
     * 根据小节ID检查课程权限
     * @param null $id
     * @return bool
     */
    protected function checkCourseBarsId($id = null)
    {
        if (is_null($id))
        {
            self::setReturn('0002', 'failed', '', '缺少小节ID');
            return false;
        }
        $BarsModel = CourseBars::findOne($id);
        if ($BarsModel == null)
        {
            self::setReturn('0002', 'failed', '','未找到该小节信息');
            return false;
        }
        else {
            $this->courseBarsInfo = $BarsModel;
            return $this->checkCourseSectionId($BarsModel->sectionid);
        }
    }

    /**
     * 根据知识点ID检查课程权限
     * @param null $id
     * @return bool
     */
    protected function checkCourseKnowsId($id = null)
    {
        if (is_null($id))
        {
            self::setReturn('0002', 'failed', '','缺少知识点ID');
            return false;
        }
        $KnowsModel = CourseKnows::findOne($id);
        if ($KnowsModel == null)
        {
            self::setReturn('0002', 'failed', '','未找到该知识点信息');
            return false;
        }
        else {
            $this->courseKnowsInfo = $KnowsModel;
            return $this->checkCourseBarsId($KnowsModel->barsid);
        }
    }
}