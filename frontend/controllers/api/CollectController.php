<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/9
 * Time: 18:10
 */

namespace frontend\controllers\api;

use common\models\Live;
use common\models\Lab;
use common\models\Practical;
use frontend\models\Course;
use frontend\models\Goods;
use Yii;

class CollectController extends ApiController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if ($this->isGuest())
        {
            return self::setReturn('0003', 'failed', '', '未登录，请先执行登陆操作！');
        }
    }


    public function actionCourse()
    {
        return $this->getCollectList(Goods::TYPE_COURSE);
    }
    public function actionLab()
    {
        return $this->getCollectList(Goods::TYPE_LAB);
    }
    public function actionLive()
    {
        return $this->getCollectList(Goods::TYPE_LIVE);
    }
    public function actionPractical()
    {
        return $this->getCollectList(Goods::TYPE_PRACTICAL);
    }


    protected function getCollectList($type)
    {
        $model = new \frontend\models\Collect();
        $pagesize = Yii::$app->request->get('pagesize', 10);
        $page = Yii::$app->request->get('page', 1);

        $query = $model->find()->where(['type'=>$type, 'userid'=>Yii::$app->user->id]);

        $totalCount = $query->count();
        $page = $page > 0 ? $page : 1;
        $pagesize = $pagesize > 0 ? $pagesize : 1;
        if ($pagesize > 20)
        {
            $pagesize = 20;
        }
        $pages = ceil($totalCount/$pagesize);
        if ($page > $pages && $pages != 0) {
            $page = $pages;
        }

        $data = $query->offset(($page -1) * $pagesize)->limit($pagesize)->asArray(true)->all();
        foreach ($data as $k => $v)
        {
            switch ($type)
            {
                case Goods::TYPE_COURSE:
                    $data[$k]['items'] = Course::findOne($v['linkid']);
                    break;

                case Goods::TYPE_LIVE:
                    $data[$k]['items'] = Live::findOne($v['linkid']);
                    break;

                case Goods::TYPE_LAB:
                    $data[$k]['items'] = Lab::findOne($v['linkid']);
                    break;

                case Goods::TYPE_PRACTICAL:
                    $data[$k]['items'] = Practical::findOne($v['linkid']);
                    break;
            }
        }
        $courseData =  [
            'data'=>$data,
            'total'=>$totalCount,
            'currentPage'=>$page,
            'pageSize'=>$pagesize
        ];
        return self::setReturn('0000', 'success',$courseData);

    }

    public function actionView($goods_id)
    {
        if (!$goods_id)
        {
            return self::setReturn('0002', 'failed', '', '缺少商品ID');
        }
        else if (($findModel = Goods::findOne($goods_id)) !== null)
        {
            if ($findModel->status == Goods::STATUS_DEFAULT)
            {
                $model = new \frontend\models\Collect();
                if (($collectModel = $model->find()->where(['goods_id'=>$goods_id, 'userid'=>Yii::$app->user->id])->one()) == null)
                {
                    return self::setReturn('0002', 'failed', '','未收藏');
                }
                else {
                    return self::setReturn('0000', 'success', '已收藏');
                }
            }
            return self::setReturn('0002', 'failed', '','商品已下架');
        }
        else {
            return self::setReturn('0002', 'failed', '','没有找到商品数据');
        }
    }

    /**
     * 添加收藏信息
     * @param $goods_id
     */
    public function actionCreate($goods_id)
    {
        if (!$goods_id)
        {
            return self::setReturn('0002', 'failed', '', '缺少商品ID');
        }
        else if (($findModel = Goods::findOne($goods_id)) !== null)
        {
            if ($findModel->status == Goods::STATUS_DEFAULT)
            {
                $model = new \frontend\models\Collect();
                if (($collectModel = $model->find()->where(['goods_id'=>$goods_id, 'userid'=>Yii::$app->user->id])->one()) == null)
                {
                    $model->linkid = $findModel->association_id;
                    $model->type = $findModel->type;
                    $model->goods_id = $findModel->goods_id;
                    $model->userid = Yii::$app->user->id;
                    $model->save();
                    if ($model->type == Goods::TYPE_COURSE)
                    {
                        $CourseModel = Course::findOne($findModel->association_id);
                        $CourseModel->likenumber = ($CourseModel->likenumber)+1;
                        $CourseModel->_save();
                    }
                    return self::setReturn('0000', 'success', '收藏成功');
                }
                else {
                    $collectModel->delete();
                    return self::setReturn('0002', 'failed', '','已取消收藏');
                }
            }
            return self::setReturn('0002', 'failed', '','商品已下架');
        }
        else {
            return self::setReturn('0002', 'failed', '','没有找到商品数据');
        }
    }
}