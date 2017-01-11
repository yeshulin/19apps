<?php

namespace backend\controllers\course;

use common\models\CourseBars;
use common\models\CourseSections;
use Yii;
use common\models\CourseKnows;
use backend\models\search\CourseKnowsSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseKnowsController implements the CRUD actions for CourseKnows model.
 */
class CourseKnowsController extends AdminController
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
     * Lists all CourseKnows models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseKnowsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('/course/knows/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseKnows model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $barsModel = CourseBars::findOne($model->barsid);
        $sectionModel = CourseSections::findOne($barsModel->sectionid);
        $model->courseid = $sectionModel->courseid;
        $model->sectionid = $sectionModel->sectionid;
        return $this->render('/course/knows/view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new CourseKnows model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourseKnows();
        $model->courseid = Yii::$app->request->get('courseid', 0);
        $model->sectionid = Yii::$app->request->get('sectionid', 0);
        $model->barsid = Yii::$app->request->get('barsid', 0);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-knows/index', 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$model->barsid]);
        } else {
            return $this->render('/course/knows/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourseKnows model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $barsModel = CourseBars::findOne($model->barsid);
        $sectionModel = CourseSections::findOne($barsModel->sectionid);
        $model->courseid = $sectionModel->courseid;
        $model->sectionid = $sectionModel->sectionid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-knows/index', 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$model->barsid]);
        } else {
            return $this->render('/course/knows/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseKnows model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $barsModel = CourseBars::findOne($model->barsid);
        $sectionModel = CourseSections::findOne($barsModel->sectionid);
        $model->courseid = $sectionModel->courseid;
        $model->sectionid = $sectionModel->sectionid;
        $model->delete();
        return $this->redirect(['course/course-knows/index', 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$model->barsid]);
    }

    /**
     * Finds the CourseKnows model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseKnows the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseKnows::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
