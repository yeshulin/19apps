<?php

namespace backend\controllers;

use backend\models\Goods;
use common\models\CourseBars;
use common\models\CourseConfig;
use common\models\CourseConfigId;
use common\models\CourseKnows;
use common\models\CourseSections;
use common\models\GoodsAttr;
use Yii;
use backend\models\Course;
use backend\models\search\CourseSearch;
use backend\controllers\AdminController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\search\CourseSectionsSearch;
use yii\web\Response;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $model->auth_count_time = $model::AUTH_TIMES;
//        var_dump($model->config);
        if ($model->load(Yii::$app->request->post()) && ($model->auth_count_time = ($model->auth_count_time * 2592000)) && $model->save()) {
            $Course = Yii::$app->request->post('Course');
            $config = '';
            if (isset($Course['config']))
            {
                $config =  $Course['config'];
            }
            $CourseConfigIdModel = new CourseConfigId();
            $CourseConfigIdModel->rewite($config, $model->course_id);
            if ($model->status == $model::STATUS_DEFAULT) {
                return $this->redirect(['create-goods', 'id' => $model->course_id]);
            }
            else {
                return $this->redirect(['view', 'id' => $model->course_id]);
            }
        } else {
            $getConfigData = CourseConfig::getConfigData();
            $model->config = $getConfigData[CourseConfig::TYPE_COURSE];
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateGoods($id)
    {
        $courseModel = $this->findModel($id);

        $goodsAttrModel = new GoodsAttr();
        $model = new Goods();
        $model->goods_name = $courseModel->course_name;
        $model->goods_thumb = $courseModel->thumb;
        $model->type = $model::TYPE_COURSE;
        $model->association_id = $courseModel->course_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $goodsAttrModel->replace(Yii::$app->request->post(), $model->goods_id);
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('/goods/create', [
                'model' => $model,
                'goodsAttrModel' => $goodsAttrModel,
            ]);
        }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && ($model->auth_count_time = ($model->auth_count_time * 2592000)) && $model->save()) {
            $CourseConfigIdModel = new CourseConfigId();
            $Course = Yii::$app->request->post('Course');
            $config = '';
            if (isset($Course['config']))
            {
                $config =  $Course['config'];
            }

            $CourseConfigIdModel->rewite($config, $model->course_id);
//            exit;
            $findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_COURSE, 'association_id'=>$model->course_id])->one();
            if ($model->status == Course::STATUS_DEFAULT)
            {
                if ($findGoodsModel == null) {
                    return $this->redirect(['create-goods', 'id' => $model->course_id]);
                }
                else {
                    $findGoodsModel->status = Goods::STATUS_DEFAULT;
                    $findGoodsModel->save();
                }
            }
            else {
                if ($findGoodsModel !== null) {
                    $findGoodsModel->status = Goods::STATUS_OUT;
                    $findGoodsModel->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->course_id]);
        } else {
            $getConfigData = CourseConfig::getConfigData();
            $model->config = $getConfigData[CourseConfig::TYPE_COURSE];
            $model->auth_count_time = $model->auth_count_time/2592000;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::STATUS_DELETE;
        if (($findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_COURSE, 'association_id'=>$model->course_id])->one()) !== null)
        {
            $findGoodsModel->status = Goods::STATUS_OUT;
            $findGoodsModel->save();
        }

        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Displays a single Course model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('course', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionInfo($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionSection($id)
    {
        $model = $this->findModel($id);
        $type = Yii::$app->request->get('type', null);
        $sectionid = Yii::$app->request->get('sectionid', 0);
        $SectionModel = CourseSections::findOne($sectionid);
        if ($type == 'del' && $SectionModel)
        {
            if (CourseBars::find()->where(['sectionid'=>$sectionid])->one() == null)
            {
                $SectionModel->delete();
            }
        }
        elseif ($type == 'edit' && $SectionModel)
        {

        }
        $searchModel = new CourseSectionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('section', [
            'model' =>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionVideo($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' =>$model,

        ]);
    }

    public function actionPinterest($id)
    {
        $this->enableCsrfValidation = false;
        $configid = Yii::$app->request->get();
        if (isset($configid['configid']))
        {
            if (empty($configid['configid']))
            {
                $model = new CourseConfigId();
                $model->deleteAll(['course_id'=>$id, 'type'=>CourseConfig::TYPE_INDEX]);
                return 200;
            } else {
                $configid = explode(',', $configid['configid']);
                $model = new CourseConfigId();
                $model->deleteAll(['course_id'=>$id, 'type'=>CourseConfig::TYPE_INDEX]);
                foreach ($configid as $v)
                {
                    $CourseConfigModel = CourseConfig::findOne(intval($v));
                    if ($CourseConfigModel != null)
                    {
                        $model->isNewRecord = true;
                        $model->course_id = $id;
                        $model->course_config_id = $CourseConfigModel->course_config_id;
                        $model->type = $CourseConfigModel->type;
                        $model->save();
                    }
                }
                return 200;
            }

        } else {
            $model = CourseConfigId::find()->where(['course_id'=>$id, 'type'=>CourseConfig::TYPE_INDEX])->asArray(true)->all();
            $result = [];
            foreach ($model as $v)
            {
                $result[$v['course_config_id']] = 99;
            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return Json::encode($result);
        }
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
