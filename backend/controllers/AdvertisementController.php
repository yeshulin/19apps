<?php

namespace backend\controllers;

use backend\models\search\AdvertisementSearch;
use common\models\Advertisement;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AdvertisementController implements the CRUD actions for Advertisement model.
 */
class AdvertisementController extends AdminController
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
     * Lists all Advertisement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertisementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advertisement model.
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
     * Creates a new Advertisement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advertisement();

        if (Yii::$app->request->isPost) {
            $alldata = Yii::$app->request->post();
            $data = $alldata['Advertisement'];
            $data['content'] = null;

            if ($data['type'] == 1) {
                if (!empty($data['ctype'])) {
                    foreach ($data['ctype'] as $key => $value) {
                        if (!empty($value) && !empty($data['curl'][$key])) {
                            $file = UploadedFile::getInstanceByName('Advertisement[ccontent][' . $key . ']');
                            if ($file) {
                                if ($path = $model->upload($file)) {
                                    $data['content'][] = ['type' => $value, 'content' => $path, 'url' => $data['curl'][$key]];
                                }
                            }
                        }
                    }
                }
            }

            if ($data['type'] == 2) {
                if (!empty($data['ctype'])) {
                    foreach ($data['ctype'] as $key => $value) {
                        if (!empty($value) && !empty($data['ccontent'][$key]) && !empty($data['curl'][$key])) {
                            $data['content'][] = ['type' => $value, 'content' => $data['ccontent'][$key], 'url' => $data['curl'][$key]];
                        }
                    }
                }
            }

            if (!empty($data['content'])) {
                $data['content'] = serialize($data['content']);
            }

            //var_dump($data);

            $alldata['Advertisement'] = $data;
            if ($model->load($alldata) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        //var_dump($model->errors);
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Advertisement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $alldata = Yii::$app->request->post();
            $data = $alldata['Advertisement'];
            $data['content'] = null;
            //var_dump($data);

            if ($data['type'] == 1) {
                if(!empty($data['octype'])){
                    foreach ($data['octype'] as $key => $value) {
                        if (!empty($value) && !empty($data['occontent'][$key]) && !empty($data['ocurl'][$key])) {
                            $data['content'][] = ['type' => $value, 'content' => $data['occontent'][$key], 'url' => $data['ocurl'][$key]];
                        }
                    }
                }
                if (!empty($data['ctype'])) {
                    foreach ($data['ctype'] as $key => $value) {
                        if (!empty($value) && !empty($data['curl'][$key])) {
                            $file = UploadedFile::getInstanceByName('Advertisement[ccontent][' . $key . ']');
                            if ($file) {
                                if ($path = $model->upload($file)) {
                                    $data['content'][] = ['type' => $value, 'content' => $path, 'url' => $data['curl'][$key]];
                                }
                            }
                        }
                    }
                }
            }

            if ($data['type'] == 2) {
                if (!empty($data['octype'])){
                    foreach ($data['octype'] as $key => $value) {
                        if (!empty($value) && !empty($data['occontent'][$key]) && !empty($data['ocurl'][$key])) {
                            $data['content'][] = ['type' => $value, 'content' => $data['occontent'][$key], 'url' => $data['ocurl'][$key]];
                        }
                    }
                }
                if (!empty($data['ctype'])) {
                    foreach ($data['ctype'] as $key => $value) {
                        if (!empty($value) && !empty($data['ccontent'][$key]) && !empty($data['curl'][$key])) {
                            $data['content'][] = ['type' => $value, 'content' => $data['ccontent'][$key], 'url' => $data['curl'][$key]];
                        }
                    }
                }
            }

            //exit();
            if (!empty($data['content'])) {
                $data['content'] = serialize($data['content']);
            }

            //var_dump($data);

            $alldata['Advertisement'] = $data;
            if ($model->load($alldata) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Advertisement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advertisement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Advertisement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advertisement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
