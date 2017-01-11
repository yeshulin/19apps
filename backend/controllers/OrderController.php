<?php

namespace backend\controllers;

use backend\models\search\OrderSearch;
use common\models\Order;
use common\models\OrderPay;
use Yii;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends AdminController
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        $data = Yii::$app->request->post();
        $op = new OrderPay();
        $op->status = 'unpay';
        $op->save();
        $data['Order']['payid'] = $op->id;
        if ($model->load($data) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = new Order;
        $model->setStatus($id, 'del');
        return $this->redirect(['index']);
    }

    public function actionFinish($id)
    {
        $order = Order::findOne($id);

        if ($order && $order['status'] == 'unpay') {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $parArr = [
                'trade_sn' => $order['trade_sn'],
            ];
            $response = $client->createRequest()
                ->setFormat("json")
                ->setMethod('post')
                ->setUrl(Yii::$app->params['staticUrl'] . "api/grant/set")
                ->setData($parArr)
                ->send();
            if ($response->isOk) {
                $model = new Order;
                $model->setStatus($id, 'success');
                return $this->redirect(['index']);
            }else{
                echo "授权错误";
            }
        }

    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
