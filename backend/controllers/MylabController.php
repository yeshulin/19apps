<?php

namespace backend\controllers;

use Yii;
use backend\models\Mylab;
use backend\models\search\MylabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MylabController implements the CRUD actions for Mylab model.
 */
class MylabController extends Controller
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
     * Lists all Mylab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MylabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mylab model.
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
     * Creates a new Mylab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mylab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lab_id]);
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
        $lab = Mylab::findOne(["lab_id"=>$postData['id']]);
        if($lab->lab_code){
            $return['code']="0003";
            $return['msg']="failed";
            $return['error']="已存有编码,不能重复修改";
        }
        $lab->lab_code=$postData["code"];
        $lab->status=2;
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
            $return['error']="修改失败";
        }
        return $return;
    }
    public function actionUrl(){
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $return=[
            "code"=>"0000",
            "msg"=>"success",
        ];
        $postData=Yii::$app->request->post();
        $lab = Mylab::findOne(["lab_id"=>$postData['id']]);
        $lab->lab_url=$postData["code"];
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
//            $return['error']="修改失败";
            $key=array_rand($lab->getErrors());
            $return['error']=array_pop($lab->getErrors()[$key]);
        }
        return $return;
    }
    public function actionBegintime(){
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $return=[
            "code"=>"0000",
            "msg"=>"success",
        ];
        $postData=Yii::$app->request->post();
        $lab = Mylab::findOne(["lab_id"=>$postData['id']]);
        $lab->begin_time=strtotime($postData["code"]);
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
//            $return['error']="修改失败";
            $key=array_rand($lab->getErrors());
            $return['error']=array_pop($lab->getErrors()[$key]);
        }
        return $return;
    }
    public function actionEndtime(){
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $return=[
            "code"=>"0000",
            "msg"=>"success",
        ];
        $postData=Yii::$app->request->post();
        $lab = Mylab::findOne(["lab_id"=>$postData['id']]);
        $lab->end_time=strtotime($postData["code"]);
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
//            $return['error']="修改失败";
            $key=array_rand($lab->getErrors());
            $return['error']=array_pop($lab->getErrors()[$key]);
        }
        return $return;
    }
    /**
     * Updates an existing Mylab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lab_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mylab model.
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
     * Finds the Mylab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mylab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mylab::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
