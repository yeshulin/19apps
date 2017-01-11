<?php

namespace backend\controllers;

use common\models\GoodsAttr;
use common\models\GoodsMerge;
use Yii;
use backend\models\Goods;
use backend\models\search\GoodsSearch;
use backend\controllers\AdminController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends AdminController
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new Goods();
        $goodsAttrModel = new GoodsAttr();
        if ($type == $model::TYPE_MERGE)
        {
            $model->scenario = 'merge';
            $model->type = $model::TYPE_MERGE;
        }
        else {
            $model->type = intval($type);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $goodsAttrModel->replace(Yii::$app->request->post(), $model->goods_id);
            if ($model->type == $model::TYPE_MERGE){
                $GoodsMergeModel = new GoodsMerge();
                $GoodsMergeModel->rewiteMerge($model);
            }
            return $this->redirect(['view', 'id' => $model->goods_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'goodsAttrModel'=>$goodsAttrModel,
            ]);
        }
    }


    /**
     * 商品组合成新商品
     * @return string|\yii\web\Response
     */
//    public function actionCreateMerge()
//    {
//        $model = new Goods();
//        $goodsAttrModel = new GoodsAttr();
//        $model->scenario = 'merge';
//        $model->type = $model::TYPE_MERGE;
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $goodsAttrModel->replace(Yii::$app->request->post(), $model->goods_id);
//            if ($model->type == $model::TYPE_MERGE){
//                $GoodsMergeModel = new GoodsMerge();
//                $GoodsMergeModel->rewiteMerge($model);
//            }
//
////            $GoodsMergeModel = new GoodsMerge();
////            $GoodsMerge = explode(',', $model->goods_merge);
////            $GoodsMergeModel->deleteAll(['goods_id'=>$model->goods_id]);
////            foreach($GoodsMerge as $Merge)
////            {
////                $GoodsMergeModel->isNewRecord = true;
////                $GoodsMergeModel->goods_id = $model->goods_id;
////                $GoodsMergeModel->merge_goods_id = $Merge;
////                if ($GoodsMergeModel->validate())
////                {
////                    $GoodsMergeModel->save();
////                }
////            }
//
//            return $this->redirect(['view', 'id' => $model->goods_id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//                'goodsAttrModel'=>$goodsAttrModel,
//            ]);
//        }
//    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $goodsAttrModel = new GoodsAttr();
        if ($model->type == $model::TYPE_MERGE)
        {
            $model->scenario = 'merge';
            foreach($model->goodsMerge as $v)
            {
                $model->goods_merge = $model->goods_merge ? $model->goods_merge.','.$v['merge_goods_id'] : $v['merge_goods_id'];
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $goodsAttrModel->replace(Yii::$app->request->post(), $id);
            if ($model->type == $model::TYPE_MERGE){
                $GoodsMergeModel = new GoodsMerge();
                $GoodsMergeModel->rewiteMerge($model);
            }
            return $this->redirect(['view', 'id' => $model->goods_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'goodsAttrModel'=>$goodsAttrModel,
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = $model::STATUS_DELETE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * 查询不包含组合商品的列表
     * @return string
     */
    public function actionNomerge()
    {
        $searchModel = new GoodsSearch();
        $query = Goods::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere([
            'status' => Goods::STATUS_DEFAULT,
        ]);
        $query->andWhere("`type` != ".Goods::TYPE_MERGE);

        $searchModel->load(Yii::$app->request->queryParams);
        $query->andFilterWhere([
            'type' => $searchModel->type,
        ]);

        $query->andFilterWhere(['like', 'goods_name', $searchModel->goods_name])
            ->andFilterWhere(['like', 'keywords', $searchModel->keywords]);

        return $this->render('nomerge', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 查询回收站信息
     * @return string
     */
    public function actionRecycled(){
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(['GoodsSearch'=>['status'=>$searchModel::STATUS_DELETE]]);

        return $this->render('recycled', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
