<?php

namespace backend\controllers;

use Yii;
use common\models\Linkage;
use yii\caching\FileCache;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LinkageController implements the CRUD actions for Linkage model.
 */
class LinkageController extends AdminController
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
     * Lists all Linkage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Linkage::find()->where(['parentid'=>0])->orderBy(['order'=>SORT_ASC]),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'breadcrumbs' =>'',
            'id' => 0,
        ]);
    }

    protected function breadcrumbs($id, $breadcrumb = []){
        if ($id) {
            $linkModel = $this->findModel($id);
            $breadcrumb[] = ['label'=>$linkModel['name'], 'url'=> Url::to(['linkage/view','id'=>$linkModel['id']])];
            if ($linkModel && $linkModel['parentid'] !== 0) {
                return $this->breadcrumbs($linkModel['parentid'], $breadcrumb);
            }
            else{
                return $breadcrumb;
            }
        }
        return $breadcrumb;
    }

    /**
     * Displays a single Linkage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $breadcrumbs = $this->breadcrumbs($id);
        unset($breadcrumbs[0]['url']);
        krsort($breadcrumbs);
        if (Linkage::find()->where(['parentid'=>$id])->one() !== null) {
            $dataProvider = new ActiveDataProvider([
                'query' => Linkage::find()->where(['parentid'=>$id])->orderBy(['order'=>SORT_ASC]),
            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'breadcrumbs' =>$breadcrumbs,
                'id' => $id,
            ]);
        }
        else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'breadcrumbs' =>$breadcrumbs,
            ]);
        }
    }

    /**
     * Creates a new Linkage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $breadcrumbs = $this->breadcrumbs($id);
        unset($breadcrumbs[0]['url']);
        krsort($breadcrumbs);

        $model = new Linkage();
        $model->parentid = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'breadcrumbs' =>$breadcrumbs,
            ]);
        }
    }

    /**
     * Updates an existing Linkage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $breadcrumbs = $this->breadcrumbs($id);
        unset($breadcrumbs[0]['url']);
        krsort($breadcrumbs);

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'breadcrumbs' =>$breadcrumbs,
            ]);
        }
    }

    /**
     * Deletes an existing Linkage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Linkage::find()->where(['parentid'=>$id])->one() === null) {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }
    public function actionCache($id)
    {
        $linkages = (new Linkage())->getLinkageList($id);
        $FileCache = new FileCache();
        $FileCache->cachePath = Yii::$app->params['cache_path'].'/../web/mlv/js/data';
        $FileCache->cacheFileSuffix = '.js';
        $FileCache->serializer = false;
        $FileCache->directoryLevel = 0;
        $FileCache->set('linkage-data-'.$id, 'var LinkAge'.$id.'='.Json::encode($linkages).';');

//        function add($Js, $id)
//        {
//            file_put_contents(Yii::$app->params['cache_path'].'/../web/mlv/js/data/linkage-'.$id.'.js', $Js, FILE_APPEND);
//        }
//        @unlink(Yii::$app->params['cache_path'].'/../web/mlv/js/data/linkage-'.$id.'.js');
//        function treeCache($data, $nid)
//        {
//            foreach ($data as $k=>$v)
//            {
//                $name = $v['name'];
//                $id = $v['id'];
//                $pid = $v['parentid'];
//                $str = "Lage[$pid][$id]=\"$name\"\n";
//                add($str, $nid);
//                if (isset($v['items']))
//                {
//                    treeCache($v['items'], $nid);
//                }
//            }
//        }
//        add("var Lage=[];\n", $id);
//        treeCache($linkages, $id);

        return $this->redirect(['index']);
    }

//    public function actionCache($id)
//    {
////        ini_set('memory_limit', '-1');
//        $linkages = (new Linkage())->getLinkageList($id);
////        $FileCache->cachePath = Yii::$app->params['cache_path'].'/linkage';
////        $FileCache->cacheFileSuffix = '.php';
////        $FileCache->serializer = false;
////        $FileCache->directoryLevel = 0;
//
//        if ($id == 1)
//        {
//            $name = 'AreaData_min';
//        }
//        else {
//            $name = 'Data'.$id;
//        }
//        $this->createArea($linkages, $name);
//        return $this->redirect(['index']);
//    }

    protected function createArea($linkages, $mlvName)
    {
//        $FileCache = new FileCache();
//        $FileCache->cachePath = Yii::$app->params['cache_path'].'/../web/mlv/js/data';
//        $FileCache->cacheFileSuffix = '.js';
//        $FileCache->serializer = false;
//        $FileCache->directoryLevel = 0;
        $Js = "var area_array=[];//省
var sub_array=[];//市
var l_arr=[];//市
var sub_arr=[];//区、县
area_array[0] = \"请选择\";\n";
        function add($Js, $mlvName)
        {
            file_put_contents(Yii::$app->params['cache_path'].'/../web/mlv/js/data/'.$mlvName.'.js', $Js, FILE_APPEND);
        }
        @unlink(Yii::$app->params['cache_path'].'/../web/mlv/js/data/'.$mlvName.'.js');

        function area_array ($data, $mlvName)
        {
            foreach ($data  as $k=>$v)
            {
                $id = $v['id'];
                $name = $v['name'];
                add("area_array[$id]=\"$name\";\n", $mlvName);
                if (isset($v['items']))
                {
                    add("sub_array[$id]=[];
sub_array[$id][0]=\"请选择\";\n", $mlvName);
                    foreach ($v['items'] as $vi)
                    {
                        $vid = $vi['id'];
                        $vname = $vi['name'];
                        add("sub_array[$id][$vid]=\"$vname\";\n", $mlvName);
                        if (isset($vi['items']))
                        {
                            add("l_arr[$vid]=\"$vname\";
sub_arr[$vid]=[];
sub_arr[$vid][0]=\"请选择\";\n", $mlvName);
                            foreach ($vi['items'] as $vii)
                            {
                                $viid = $vii['id'];
                                $viname = $vii['name'];
                                add("sub_arr[$vid][$viid]=\"$viname\";\n", $mlvName);
                            }
                        }
                    }
                }
            }
        }
        add($Js, $mlvName);
        area_array($linkages, $mlvName);
//        $FileCache->set('AreaData_min', $Js);

    }

    /**
     * Finds the Linkage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Linkage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Linkage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
