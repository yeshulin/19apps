<?php

namespace backend\controllers;

use Yii;
use backend\models\Mypractical;
use backend\models\search\MypracticalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MypracticalController implements the CRUD actions for Mypractical model.
 */
class MypracticalController extends Controller
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
     * Lists all Mypractical models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MypracticalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mypractical model.
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
     * Creates a new Mypractical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mypractical();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->practical_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mypractical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->practical_id]);
        } else {
            return $this->render('update', [
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
        $lab = Mypractical::findOne(["practical_id"=>$postData['id']]);
        if($lab->practical_code){
            $return['code']="0003";
            $return['msg']="failed";
            $return['error']="已存有编码,不能重复修改";
        }
        $lab->practical_code=$postData["code"];
        $lab->status=2;
        if(!$lab->save()){
            $return['code']="0001";
            $return['msg']="failed";
            $return['error']="修改失败";
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
        $lab = Mypractical::findOne(["practical_id"=>$postData['id']]);
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
        $lab = Mypractical::findOne(["practical_id"=>$postData['id']]);
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
    public function actionUrl(){
        Yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $return=[
            "code"=>"0000",
            "msg"=>"success",
        ];
        $postData=Yii::$app->request->post();
        $lab = Mypractical::findOne(["practical_id"=>$postData['id']]);
        $lab->practical_url=$postData["code"];
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
     * Deletes an existing Mypractical model.
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
     * Finds the Mypractical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mypractical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mypractical::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
