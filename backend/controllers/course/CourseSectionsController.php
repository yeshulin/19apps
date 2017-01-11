<?php

namespace backend\controllers\course;

use Yii;
use common\models\CourseSections;
use backend\models\search\CourseSectionsSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseSectionsController implements the CRUD actions for CourseSections model.
 */
class CourseSectionsController extends AdminController
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
     * Lists all CourseSections models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSectionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('/course/section/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseSections model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->redirect(['course/course-bars/index', 'courseid'=>$model->courseid, 'sectionid'=>$id]);
    }

    /**
     * Creates a new CourseSections model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourseSections();
        $model->courseid = Yii::$app->request->get('courseid', 0);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-sections/index', 'courseid' => $model->courseid]);
        } else {
            return $this->render('/course/section/create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourseSections model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['course/course-sections/index', 'courseid' => $model->courseid]);
        } else {
            return $this->render('/course/section/update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CourseSections model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        CourseSections::_delete($model);

        return $this->redirect(['index', 'courseid' => $model->courseid]);
    }

    /**
     * Finds the CourseSections model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseSections the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseSections::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
