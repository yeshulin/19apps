<?php

namespace backend\controllers;

use frontend\models\Member;
use Yii;
use backend\models\Activation;
use backend\models\search\ActivationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivationController implements the CRUD actions for Activation model.
 */
class ActivationController extends Controller
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
     * Lists all Activation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivationSearch();
//        var_dump(Yii::$app->request->queryParams);exit;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Activation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type = '', $num = 1, $id = 0, $userid = 0)
    {
        $model = new Activation();
        $model->product_id = $type;
        $model->num = $num;
        $model->p_type_id = $id;

        //m_user
        $model->m_userid = $userid;
        $member = Member::findByUserid($userid);
        $model->m_username = empty($member) ? "admin" : $member->username;
        if ($model->load(Yii::$app->request->post()) && $model->make()) {
            return $this->redirect(['index']);
//            return $this->redirect(['view', 'id' => $model->activid]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'type' => $type
            ]);
        }
    }

    /**
     * Updates an existing Activation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->activid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Activation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Activation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
