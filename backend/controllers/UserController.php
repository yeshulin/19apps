<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\Role;
use Yii;
use backend\models\User;
use backend\models\search\UserSearch;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AdminController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $roleModel = new Role();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $roleName = Yii::$app->request->post('Role');
            $roleName = $roleName['name'];
            if ($roleName) {
                $authManager = Yii::$app->authManager;
                $role = $authManager->getRole($roleName);
                $authManager->assign($role, $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'roleModel'=>$roleModel,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $authManager = Yii::$app->authManager;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $roleName = Yii::$app->request->post('Role');
            $roleName = $roleName['name'];
            if ($roleName) {
                $role = $authManager->getRole($roleName);
                $authManager->revokeAll($model->id);
                $authManager->assign($role, $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $getRolesByUser = key($authManager->getRolesByUser($id));
            $roleModel = new Role();
//            var_dump($getRolesByUser);
            $roleModel->name = $getRolesByUser;
            return $this->render('update', [
                'model' => $model,
                'roleModel' => $roleModel,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
