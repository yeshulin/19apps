<?php

namespace backend\controllers;

use backend\models\Route;
use backend\models\search\AuthItemSearch;
use Yii;
use backend\models\Role;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends AdminController
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch(['type'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Yii::$app->authManager->getRole($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->_save()) {
                return $this->redirect(['view', 'id' => $model->name]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new Role();
        if($model->load(Yii::$app->request->post())){
            $authManager = \Yii::$app->authManager;
            $role = $authManager->getRole($id);
            if ($role) {
                $model->_update($id);
                return $this->redirect(['view', 'id' => $model->name]);
            }
        }
        return $this->render('update',[
            'model'=>$model::findOne($id),
        ]);

    }

    public function actionNode($id){
//        $authManager = \Yii::$app->authManager;
        $model = new Role();
        return $this->render('node',[
            'id'=>$id,
            'Routes'=>$model->getRolePermission($id),
        ]);
    }


    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $authManager = \Yii::$app->authManager;
        $role = $authManager->getRole($id);
        if($role) {
            $authManager->remove($role);
        }
        return $this->redirect(['index']);
    }

    public function actionAssign(){
        Yii::$app->getResponse()->format = 'json';
        $routes = Yii::$app->getRequest()->post('routes', []);

        $id = Yii::$app->getRequest()->post('id','');
        $routes = explode('||', $routes);
        $authManager = Yii::$app->authManager;

        $role = $authManager->getRole($id);

        $RolePermission = array_keys($authManager->getPermissionsByRole($id));

        foreach ($routes as $v)
        {
            if ($v == '*::*' && ($preModel = $authManager->getPermission($v)) !== null) {
                $authManager->addChild($role, $preModel);
            }
            else {
                $here = strrpos($v, '::');
                $left = substr($v, 0, $here);
                if (trim(substr($v, $here)) == '*' && ($preModel = $authManager->getPermission($v)) !== null) {
                    foreach ($RolePermission as $v)
                    {
                        if (preg_match("/^$left::[\w]+$/", $v)) {
                            $leftModel = $authManager->getPermissions($v);
                            $authManager->removeChild($role, $leftModel);
                        }
                    }
                    $authManager->addChild($role, $preModel);
                }
                else {
                    if(!in_array($left.'::*', $RolePermission) && ($preModel = $authManager->getPermission($v)) !== null){
                        $authManager->addChild($role, $preModel);
                    }
                }
            }
        }

        $route = new Role();
        return $route->getRolePermission($id);
    }

    public function actionRemove(){
        Yii::$app->getResponse()->format = 'json';
        $routes = Yii::$app->getRequest()->post('routes', []);
        $id = Yii::$app->getRequest()->post('id','');
        $routes = explode('||', $routes);
        $authManager = Yii::$app->authManager;

        $role = $authManager->getRole($id);
        foreach ($routes as $v)
        {
            if(($preModel = $authManager->getPermission($v)) !== null){

                $authManager->removeChild($role, $preModel);
            }
        }

        $route = new Role();
        return $route->getRolePermission($id);
    }

    public function actionRefresh(){
        Yii::$app->getResponse()->format = 'json';
        $id = Yii::$app->getRequest()->post('id','');
        $route = new Role();
        return $route->getRolePermission($id);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
//    protected function findModel($id)
//    {
//        if (($model = Role::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
}
