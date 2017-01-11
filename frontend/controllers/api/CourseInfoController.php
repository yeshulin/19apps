<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/16
 * Time: 17:34
 */

namespace frontend\controllers\api;


use common\models\CourseBars;
use common\models\CourseKnows;
use common\models\CourseSections;
use frontend\models\Video;
use yii\helpers\ArrayHelper;
use Yii;

class CourseInfoController extends ApiController
{
    public $allowHash = false;

    //课程目录信息
    public function actionIndex($id)
    {
        if (($idType = Yii::$app->request->get('idType', null)) != null)
        {
            $_isBars = false;
            $_isSection = false;
            if ($idType == 'knows')
            {
                $id = CourseKnows::findOne($id)->barsid;
                $_isBars = true;
            }

            if ($idType == 'bars' || $_isBars)
            {
                $id = CourseBars::findOne($id)->sectionid;
                $_isSection = true;
            }

            if ($idType == 'sections' || $_isSection)
            {
                $id = CourseSections::findOne($id)->courseid;
            }
        }
        $CourseSections = CourseSections::find()->where(['courseid'=>$id])
                ->select(['sectionid','name'])
                ->orderBy(['order'=>SORT_DESC])->asArray(true)->all();
        foreach ($CourseSections as $ks => $vs)
        {
            $CourseSections[$ks]['CourseBars'] = CourseBars::find()->where(['sectionid'=>$vs['sectionid']])
                    ->select(['barsid','name'])
                    ->orderBy(['order'=>SORT_DESC])->asArray(true)->all();
            foreach ($CourseSections[$ks]['CourseBars'] as $kb => $vb)
            {
                $CourseSections[$ks]['CourseBars'][$kb]['CourseKnows'] = CourseKnows::find()->where(['barsid'=>$vb['barsid']])
                        ->select(['knowsid','name', 'type', 'linkid'])
                        ->orderBy(['order'=>SORT_DESC])->asArray(true)->all();
                foreach ($CourseSections[$ks]['CourseBars'][$kb]['CourseKnows'] as $kn => $vn)
                {
                    if ($vn['type'] == 1)
                    {
                        $CourseSections[$ks]['CourseBars'][$kb]['CourseKnows'][$kn] = ArrayHelper::merge($vn, Video::find()->where(['videoid'=>$vn['linkid']])
                                    ->select(['time'])->asArray(true)->one());
                    }
                }

            }
        }
//                ->joinWith(['CourseBars'])
//                ->joinWith(['CourseKnows'])
//                ->asArray(true)->all();
        return self::setReturn('0000', 'success', $CourseSections);
    }
}