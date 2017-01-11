<?php

namespace backend\controllers;

use backend\models\Goods;
use common\models\GoodsAttr;
use Yii;
use backend\models\Certification;
use backend\models\search\CertificationSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificationController implements the CRUD actions for Certification model.
 */
class CertificationController extends AdminController
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
     * Lists all Certification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Certification model.
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
     * Creates a new Certification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Certification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->status == $model::STATUS_DEFAULT) {
                return $this->redirect(['create-goods', 'id' => $model->certificationid]);
            }
            else {
                return $this->redirect(['view', 'id' => $model->certificationid]);
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
        $model->goods_name = $labModel->certification_name;
//        $model->goods_thumb = $labModel->thumb;
        $model->type = $model::TYPE_ZYRZ;
        $model->association_id = $labModel->certificationid;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $goodsAttrModel->replace(Yii::$app->request->post(), $id);
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('/goods/create', [
                'model' => $model,
                'goodsAttrModel'=>$goodsAttrModel,
            ]);
        }
    }

    /**
     * Updates an existing Certification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_ZYRZ, 'association_id'=>$model->certificationid])->one();
            if ($model->status == $model::STATUS_DEFAULT)
            {
                if ($findGoodsModel == null) {
                    return $this->redirect(['create-goods', 'id' => $model->certificationid]);
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
            return $this->redirect(['view', 'id' => $model->certificationid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Certification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = $model::STATUS_DELETE;
        if (($findGoodsModel = Goods::find()->where(['type'=>Goods::TYPE_ZYRZ, 'association_id'=>$model->certificationid])->one()) !== null)
        {
            $findGoodsModel->status = Goods::STATUS_OUT;
            $findGoodsModel->save();
        }

        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Certification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Certification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Certification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
