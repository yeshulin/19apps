<?php

namespace backend\controllers;

use Yii;
use backend\models\Live;
use backend\models\search\LiveSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Goods;
use common\models\GoodsAttr;

/**
 * LiveController implements the CRUD actions for Live model.
 */
class LiveController extends AdminController
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
     * Lists all Live models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Live model.
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
     * Creates a new Live model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Live();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->status == $model::STATUS_DEFAULT) {
                return $this->redirect(['create-goods', 'id' => $model->liveid]);
            }
            else {
                return $this->redirect(['view', 'id' => $model->liveid]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 生成相应商品
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreateGoods($id)
    {
        $labModel = $this->findModel($id);

        $goodsAttrModel = new GoodsAttr();
        $model = new Goods();
        $model->goods_name = $labModel->live_name;
        $model->goods_thumb = $labModel->thumb;
        $model->type = $model::TYPE_LIVE;
        $model->association_id = $labModel->liveid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $goodsAttrModel->replace(Yii::$app->request->post(), $model->goods_id);
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('/goods/create', [
                'model' => $model,
                'goodsAttrModel'=>$goodsAttrModel,
            ]);
        }
    }

    /**
     * Updates an existing Live model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_LIVE, 'association_id'=>$model->liveid])->one();
            if ($model->status == Live::STATUS_DEFAULT)
            {
                if ($findGoodsModel == null) {
                    return $this->redirect(['create-goods', 'id' => $model->liveid]);
                }
                else {
                    $findGoodsModel->status = Goods::STATUS_DEFAULT;
                    $findGoodsModel->save();
                }
            }
            else {
                if ($findGoodsModel !== null) {
                    $findGoodsModel->status = Goods::STATUS_OUT;
                    $findGoodsModel->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->liveid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Live model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::STATUS_DELETE;
        if (($findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_COURSE, 'association_id'=>$model->liveid])->one()) !== null)
        {
            $findGoodsModel->status = Goods::STATUS_OUT;
            $findGoodsModel->save();
        }

        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Live model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Live the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Live::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
