<?php

namespace backend\controllers;

use Yii;
use backend\models\Video;
use backend\models\search\VideoSearch;
use backend\controllers\AdminController;
use yii\bootstrap\Html;
use yii\caching\FileCache;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends AdminController
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Video models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new VideoSearch();
        $searchModel->status = Video::STATUS_DEFAULT;
        $catalogPath = Yii::$app->request->get('catalogPath', null);
        if (!is_null($catalogPath))
        {
            $searchModel->type = $catalogPath;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Video model.
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
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Video();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->videoid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->videoid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPlay($id)
    {
        $model = $this->findModel($id);
        $vms = new \common\components\Vms();
        return $vms->vmsVideoPlay($model->vmsid);
    }

    public function actionSyncVmsVideo()
    {
        Yii::$app->request->enableCsrfValidation = false;
        $vms = new \common\components\Vms();
        $catalogId = Yii::$app->request->get('catalogId', null);
        if (!is_null($catalogId))
        {
            $getVideoListConfig = [
                'catalogStyle'=>1,
                'catalogPath'=>$catalogId,
                'getAllData'=>0,
                'pageSize'=>10,
                'pageNum'=>Yii::$app->request->get('page', 1),
                'sortField'=>'PublishDate',
                'sort'=>'DESC',
            ];
            $VideoName = Yii::$app->request->get('VideoName', '');
            if (!empty($VideoName))
            {
                $getVideoListConfig['keywords'] = $VideoName;
            }
            $startTime = Yii::$app->request->get('startTime', '');
            if (!empty($startTime))
            {
                $getVideoListConfig['startTime'] = $startTime.' 00:00:00';
            }
            $endTime = Yii::$app->request->get('endTime', '');
            if (!empty($endTime))
            {
                $getVideoListConfig['endTime'] = $endTime.' 23:59:59';
            }
            $data = $vms->getVideoList($getVideoListConfig);
//            var_dump($getVideoListConfig);
            return $this->render('vms-list', [
                'data' => $data,
                'pages'=>new Pagination(['totalCount'=>$data['pageTotal'], 'pageSize'=>$data['pageSize']]),
                'type' => 'list',
            ]);
        } else {
            $CatalogList = $vms->getCatalogList();
            $FileCache = new FileCache();
            $FileCache->set('VmsCatalogListCache', $CatalogList);
//            function VmsCatalog($CatalogList, $parent = 0)
//            {
//                static $result = [];
//                foreach ($CatalogList as $k => $v)
//                {
//                    if ($v['parentId'] == $parent) {
//                        $result[$v['catalogId']] = '├'.str_repeat('－', $v['treeLevel']*2) .$v['name'];
//                        VmsCatalog($CatalogList, $v['catalogId']);
//                    }
//                }
//                return $result;
//            }
//            $result = VmsCatalog($CatalogList);
            return $this->render('vms-list', [
                'data' => $CatalogList,
                'pages'=>'',
                'type' => 'select',
            ]);
        }
    }

    public function actionSync()
    {
        Yii::$app->request->enableCsrfValidation = false;
        $fData = Yii::$app->request->post('fData', '');
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!empty($fData))
        {
            $Video = explode('|', $fData);
            foreach ($Video as $v)
            {
                $model = new Video();
                $video = null;
                $video = explode('--', $v);
                $vmsid = $video[0];
                if (($VideoModel = Video::find()->where(['vmsid'=> $vmsid])->one()) == null)
                {
                    $model->vmsid = $vmsid;
                    $model->videoname = $video[1];
                    $model->create_at = strtotime($video[2]);
                    $model->type = $video[3];
                    $model->thumb = $video[4];
                    $model->time = $video[5];
                    $model->save();
                } else {
                    if ($VideoModel->type != $video[3]){
                        $VideoModel->type = $video[3];
                        $VideoModel->save();
                    }
                }
            }
            return 200;
        }
        return 300;
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
