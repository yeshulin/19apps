<?php

namespace backend\controllers\course;

use common\models\CourseSections;
use Yii;
use common\models\CourseBars;
use backend\models\search\CourseBarsSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseBarsController implements the CRUD actions for CourseBars model.
 */
class CourseBarsController extends AdminController
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
     * Lists all CourseBars models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseBarsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('/course/bars/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseBars model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $SectionModel = CourseSections::findOne($model->sectionid);
        $model->courseid = $SectionModel->courseid;
        return $this->redirect(['course/course-knows/index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$id]);
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
    }

    /**
     * Creates a new CourseBars model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourseBars();
        $model->sectionid = Yii::$app->request->get('sectionid', 0);
        $model->courseid = Yii::$app->request->get('courseid', 0);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-bars/index', 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid]);
        } else {
            return $this->render('/course/bars/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourseBars model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $SectionModel = CourseSections::findOne($model->sectionid);
        $model->courseid = $SectionModel->courseid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-bars/index', 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid]);
        } else {
            return $this->render('/course/bars/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseBars model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        CourseBars::_delete($model);

        return $this->redirect(['index' , 'courseid' => $model->courseid, 'sectionid'=>$model->sectionid]);
    }

    /**
     * Finds the CourseBars model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseBars the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseBars::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
