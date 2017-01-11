<?php


namespace frontend\controllers\api;

use Yii;
use frontend\models\FormCollege;
use yii\filters\AccessControl;
use frontend\models\Search\ContentSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganController implements the CRUD actions for Organ model.
 */
class CollegeController extends CurdController
{
    public $enableCsrfValidation = false;//关闭csrf验证
    public $orderField=[
        'id'  , 'userid' , 'order'  , 'created_at', 'updated_at',
        //'videoPath', 'content', 'status'
    ];
    public $searchField=[
        'title'  , 'catid' , 'keywords'  , 'description', 'username','content'
        //'videoPath', 'content', 'status'
    ];
    public $modelName="FormCollege";
    public $searchModelName="FormCollegeSearch";
    public $namespace="\\frontend\\models\\";
    public $action=['list',"view"];//允许的操作
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
//        $this->guestQuit();
    }
    public function _view($model, $namespace = "\\frontend\\models\\")
    {
        if (!Yii::$app->request->isPost) {
            if(isset($this->queryParams['id'])){
                $this->rawBody['id']=intval($this->queryParams['id']);
            }
        }
            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '') {
                $id=$this->rawBody['id'];
                $college['photo'] = (new \yii\db\Query())->select(['co_form_photos.*'])
                    ->from('co_form_photos')
                    ->innerJoin('co_form_college', 'co_form_college.id = co_form_photos.college')
                    ->where(['co_form_college.id' => $id])
                    ->all();
                $college['collection'] = (new \yii\db\Query())->select(['co_form_collection.*'])
                    ->from('co_form_collection')
                    ->innerJoin('co_form_college', 'co_form_college.id = co_form_collection.college')
                    ->where(['co_form_college.id' => $id])
                    ->all();
//                $model = $this->findModel($this->rawBody['id'], '', $model, $namespace);
                if (!empty($college['photo']) || !empty($college['collection'])) {
                    $this->setReturn('', '', $college);
                } else {
                    $this->setReturn("0002", "failed", '', "没有相关的数据");
                }
            } else {
                $this->setReturn("0003", "failed", '', "缺少参数");
            }
        //parent::_create($model, $namespace = "\\frontend\\models\\");
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