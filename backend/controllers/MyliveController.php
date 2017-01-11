<?php

namespace backend\controllers;

use Yii;
use backend\models\Mylive;
use backend\models\search\MyliveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MyliveController implements the CRUD actions for Mylive model.
 */
class MyliveController extends Controller
{
    public $enableCsrfValidation = false;//关闭csrf验证
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
     * Lists all Mylive models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MyliveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mylive model.
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
     * Creates a new Mylive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mylive();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->live_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    //
    public function actionCode(){
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $return=[
            "code"=>"0000",
            "msg"=>"success",
        ];
        $postData=Yii::$app->request->post();
        $lab = Mylive::findOne(["live_id"=>$postData['id']]);
        if($lab->roomid){
            $return['code']="0003";
            $return['msg']="failed";
            $return['error']="已存有编码,不能重复修改";
        }
        $lab->roomid=$postData["code"];
        $lab->status=2;
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
            $return['error']="修改失败";
        }
        return $return;
    }
    /**
     * Updates an existing Mylive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->live_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mylive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $model->status=0;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mylive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mylive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mylive::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
