<?php


namespace frontend\controllers\api;

use Yii;
use frontend\models\Content;
use yii\filters\AccessControl;
use frontend\models\Search\ContentSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganController implements the CRUD actions for Organ model.
 */
class PhotoController extends CurdController
{
    public $enableCsrfValidation = false;//关闭csrf验证
    public $orderField=[
        'id'  , 'userid' , 'order'  , 'inputtime', 'updatetime',
        //'videoPath', 'content', 'status'
    ];
    public $searchField=[
        'title'  , 'catid' , 'keywords'  , 'description', 'username','content'
        //'videoPath', 'content', 'status'
    ];
    public $modelName="FormPhoto";
    public $searchModelName="FormPhotoSearch";
    public $namespace="\\frontend\\models\\";
    public $action=[];//允许的操作
//    public $action=['list',"view",'create','update','delete'];//允许的操作
    public $returnField=['*'];
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['list','view'],
//                        'allow' => true,
//                    ],
//                ],
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function  init(){
        parent::init();
        $this->guestQuit();
    }
	public function _create($model, $namespace = "\\frontend\\models\\")
    {
		$this->getUid();
        parent::_create($model, $namespace = "\\frontend\\models\\");
    }
    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
//    protected function findContent($id)
//    {
//        return $this->findModel($id,true,"Content","\\backend\\models");
//    }
}