<?php

namespace frontend\controllers\api;

use backend\models\AuthAssignment;
use common\helpers\Message;
use Yii;
use \yii\web\Controller;
use frontend\models\Member;
use backend\models\search\MemberSearch;
use backend\models\search\ContentSearch;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * 用户接口类，用于用户的更新，查询，添加
 */
class CurdController extends ApiController
{
    public $allowHash;
    public $queryParamsUrl;
    public $queryParams;
    /*
     * 数据以JSON格式返回
     * */
    public function init()
    {
        $this->queryParams = Yii::$app->request->queryParams;
        if(isset($this->queryParams['r'])){
            unset($this->queryParams['r']);
        }
        $queryParamsUrl = Yii::$app->request->getPathInfo();
        $request = explode('/', $queryParamsUrl);
        $method=$request[2];
//        $pattern='/(\w+)([&?])([\s\S]+)/';
//        if(preg_match($pattern,$method,$match)){
//            var_dump($match);exit;
//            $request=$match[1];
//        }
        if (!in_array($method, $this->action)) {
            $this->setReturn("0003", "failed", '', "没有授权的操作");
        }
        $this->allowHash=false;
        parent::init();
		$this->setParams();
    }

    /**
     * @inheritdoc
     *
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

    public function actionView()
    {
        $this->_View($this->modelName);
    }

    public function actionList()
    {
        $this->_list($this->searchModelName, $this->orderField, $this->searchField,$this->namespace);
    }

    public function actionDelete()
    {
        $this->_deleta($this->modelName, $this->namespace);
    }

    public function actionCreate()
    {
        $this->_create($this->modelName,$this->namespace);
    }
    public function actionUpdate(){
        $this->_update($this->modelName,$this->namespace);
    }
    //获取单条数据
    public function _View($model, $namespace = "\\frontend\\models\\",$checkUserNot=true)
    {
       // Yii::info("获取内容VIew","apiLog");
        if (!Yii::$app->request->isPost) {
            if(isset($this->queryParams['id'])){
                $this->rawBody['id']=intval($this->queryParams['id']);
            }
        }
        Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
        if (isset($this->rawBody['id']) && $this->rawBody['id'] != '') {
            $model = $this->findModel($this->rawBody['id'], '', $model, $namespace);
            if ($model !== NULL && ($checkUserNot || $model->userid==Yii::$app->user->id)) {
                $this->setReturn('', '', $model->toArray());
            } else {
                $this->setReturn("0002", "failed", '', "没有相关的数据");
            }
        } else {
            $this->setReturn("0003", "failed", '', "缺少参数");
        }
    }
    //获取列表
    /*
     * @orderField   排序字段
     * @searchField  允许搜索字段
     * */
    public function _list($SearchModel, $orderField, $searchField,$namespace = "\\frontend\\models\\")
    {
        if (!Yii::$app->request->isPost) {
            $queryParams = $this->queryParams;
            $this->rawBody['page']=isset($queryParams['page'])?$queryParams['page']:'';
            $this->rawBody['pageSize']=isset($queryParams['pageSize'])?$queryParams['pageSize']:'';
            $this->rawBody['order']=isset($queryParams['order'])?json_decode($queryParams['order'],true):'';
            $this->rawBody['params']=isset($queryParams['params'])?json_decode($queryParams['params'],true):'';
            if(isset($this->rawBody['params']['id'])){
                $this->rawBody['params']['id']=intval($this->rawBody['params']['id']);
            }
            $this->setParams();
        }
//            $SearchModel = "frontend\\models\\Search\\" . $SearchModel;
            $SearchModel = $namespace ."search\\". $SearchModel;
            $searchModel = new $SearchModel();
            $pageSize = 10;
            $page = 1;
            $order = ["id" => SORT_ASC];
            Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
            if (isset($this->rawBody['pageSize']) && $this->rawBody['pageSize'] != '') $pageSize = intval($this->rawBody['pageSize']);
            if (isset($this->rawBody['page']) && $this->rawBody['page'] != '') {
                $page = intval($this->rawBody['page']);
                unset($this->rawBody['page']);
            }
            if (isset($this->rawBody['order']) && $this->rawBody['order'] != '') {
                foreach ($this->rawBody['order'] as $k => $val) {
                    if (!in_array($k, $orderField)) {
                        unset($this->rawBody['order'][$k]);
                    } else {
                        $this->rawBody['order'][$k] = strtolower($val) == "desc" ? SORT_DESC : SORT_ASC;
                    }
                }
                $order = $this->rawBody['order'];
            }
//            var_dump($this->rawBody);exit;
            $skip = ($page - 1) * $pageSize;
            foreach ($this->rawBody[$SearchModel] as $k => $val) {
                if (!in_array($k, $searchField)) {
                    unset($this->rawBody[$SearchModel][$k]);
                }
            }
            $contentSeacrh = $searchModel->search($this->rawBody);
            $content = $contentSeacrh->query->offset($skip)->limit($pageSize)->orderBy($order);
            if ($count = $content->count()) {
                $modelArr = $content->all();
                $returnData['total'] = $count;
                $returnData['currentPage'] = $page;
                $returnData['pageSize'] = $pageSize;
                $returnData['data'] = $modelArr;
                $this->setReturn('', '', $returnData);
            } else {
                $this->setReturn("0002", "failed", '', "没有找到相关数据");
            }

    }
    //删除
    public function _deleta($model, $namespace = "\\frontend\\models\\")
    {
        Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
        if (Yii::$app->request->isPost) {
            if (isset($this->rawBody['id']) && $this->rawBody['id'] != '') {
                $model = $this->findModel($this->rawBody['id'], '', $model, $namespace);
                if (!empty($model) && $model->delete()) {
                    $this->setReturn('', '', NULL);
                } else {
                    $this->setReturn("0001", "failed", '', empty($model) ? "非法参数" : "删除失败");
                }
            } else {
                $this->setReturn("0003", "failed", '', "缺少参数");
            }
        } else {
            $this->setReturnUsePost();
        }
    }
    //新增
    public function _create($model, $namespace = "\\frontend\\models\\")
    {
        Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
        if (Yii::$app->request->isPost) {
            $models=$namespace.$model;
            $model = new $models();
            Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
            if ($model->load($this->rawBody) && $model->save()) {
                $this->setReturn('', '', NULL);
            } else {
                $this->setReturn("0001", "failed", '', $model->getErrors());
            }
        }else{
            $this->setReturnUsePost();
        }
    }
    //更改
    public function _update($model, $namespace = "\\frontend\\models\\")
    {
        Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
        if (Yii::$app->request->isPost) {
            if($id = $this->rawBody['id']) {
                $models = $namespace.$model;
                Yii::info("接受数据:".print_r($this->rawBody,true),"apiLog");
                $model=$this->findModel($id,false,$model,$namespace);
				if(empty($model)){
					$this->setReturn("0001", "failed", '', "没有这个数据");
				}
                if($model->userid!=$this->rawBody[$this->modelName]['userid']){
                    $this->setReturn("0001", "failed", '', "无效的Id");
                }
                if ($model->load($this->rawBody) && $model->save()) {
                    $this->setReturn('', '', NULL);
                } else {
                    $this->setReturn("0001", "failed", '', $model->getErrors());
                }
            }else{
                $this->setReturn("0001", "failed", '', "缺少参数Id");
            }
        }else{
            $this->setReturnUsePost();
        }
    }
    public function guestQuit(){
        \frontend\controllers\api\MemberController::guestQuit();
    }
	//获取当前用户Id
	public function getUid(){
		$uid=Yii::$app->user->id;//当前用户id
        $this->rawBody[$this->modelName]['userid']=$uid;
        $this->rawBody[$this->searchModelName]['userid']=$uid;
        $this->getUsername();
	}
    public function getUsername(){
        $username = Yii::$app->user->getIdentity()->username;
        $this->rawBody[$this->modelName]['username']=$username;
        $this->rawBody[$this->searchModelName]['username']=$username;
    }
	public function setParams(){
		$this->rawBody[$this->modelName]=$this->rawBody['params'];
		$this->rawBody[$this->searchModelName]=$this->rawBody['params'];
	}
    public function setSendUserid(){
        $username = Yii::$app->user->getIdentity()->username;;//当前用户名
        $this->rawBody[$this->modelName]['send_to_id']=$username;
        $this->rawBody[$this->searchModelName]['send_to_id']=$username;
    }
}
