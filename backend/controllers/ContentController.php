<?php

namespace backend\controllers;

use Yii;
use frontend\models\Content;
use frontend\models\search\ContentSearch;
use backend\controllers\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends AdminController
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
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
//        var_dump(Yii::$app->request->queryParams);exit;
        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
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
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Content();
        $data=Yii::$app->request->post();
        if(isset($data['Content']))  $data['Content']['content']=$this->replaceVideo($this->replaceAudio($data['Content']['content']));
        if(Yii::$app->request->isPost) $model->username=Yii::$app->user->getIdentity()->username;
        if ($model->load($data) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            var_dump($model->getErrors());
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data=Yii::$app->request->post();
//        var_dump($data['Content']['content']);exit;
        if(isset($data['Content'])) $data['Content']['content']=$this->replaceVideo($this->replaceAudio($data['Content']['content']));
//        if(isset($data['Content'])) $data['Content']['content']=$this->replaceVideo($this->replaceAudio($data['Content']['content']));
        $model = $this->findModel($id);
        if ($model->load($data) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetVideoVms(){
        // if (!$this->check_priv('video2content')) {
        //     showmessage('您没有权限操作该项','blank');
        // }
        /*
        $where = '`status`=21';
        $page = max(intval($_GET['page']), 1);
        $pagesize = 6;
        if (!param::get_cookie('admin_username')) {
            $where .= " AND `userid`='".$this->userid."'";
        }
        $infos = $this->db->listinfo($where, 'videoid DESC', $page, $pagesize);
        $number = $this->db->number;
        $pages = $this->pages($number, $page, $pagesize, 4, 'get_videoes');
        $flash_info = $this->ku6api->flashuploadparam();*/
//        var_dump(Yii::$app->request->get());
        $get=Yii::$app->request->get();
        $getType=isset($get['getType'])?$get['getType']:'Video';
        $page=isset($get['page'])?$get['page']:1;
        $name=isset($get['name'])?$get['name']:'';
        $starttime=isset($get['starttime'])?$get['starttime']:'';
        $endtime=isset($get['endtime'])?$get['endtime']:'';
        $pageSize=isset($get['pagesize'])?intval($get['pagesize']):8;
        $where='';
        if(trim($name)){
          $where='&keywords='.$name;
        }
        if (isset($starttime) && !empty($starttime)) {
          $where .= '&startTime='.$starttime;
        }
        if (isset($endtime) && !empty($endtime)) {
          $endtime=date('Y-m-d',(strtotime($endtime)+86400));
          $where .= '&endTime='.$endtime;
        }
        $vms_token=Yii::$app->params['vms_token'];//获取vms的token值
        $vms_path=Yii::$app->params['vms_path'];//获取vms的地址
        $isAudio=$getType=="Audio";
        $method=$isAudio?"getAudioList":"getVideoList";
        $url=$vms_path . '?method='.$method.'&partnerToken='.$vms_token.'&dataType=json&catalogStyle=0&catalogPath=7&getAllData=1&pageSize='.$pageSize.'&pageNum='.$page.'&sortField=PublishDate&sort=ASC'.$where;
        $data=file_get_contents($url,true);
        $data=json_decode($data,true);
        //print_r($data);
        $num=$data['total'];
        $video_list=$data;
        $pages = $this->pages($num, $page, $perpage = 8, $urlrule = '', $array = array(),$setpages = 8) ;
        $view=$isAudio?"VmsAudio":"VmsVideo";
        return $this->render($view, [
            'infos' => $video_list,
            'pages'=>$pages,
            'get'=>$get
        ]);
        //$infos = $this->db->listinfo($where, '`videoid` DESC', $page, $pagesize);


        //include $this->admin_tpl('album_list');

    }
    private function replaceVideo($content){
        $pattern="/<div(\s+)class=\"vms-video\"([\s\S]+)<div(\s+)id=\"(\S+)\">(\s+)<br(\s+)\/>(\s+)<\/div>(\s+)<\/div>/";;
        if(preg_match($pattern,$content,$matchs)) {
            $vms_video = AdminController::playVmsVideo($matchs[4]);
            $replace = "<div$1class=\"play-vms-video\"$2<div$3id=\"$4\">" . $vms_video . "<br$6/>$7</div>$8</div>";
            return preg_replace($pattern, $replace, $content);
        }
        return $content;
    }
    private function replaceAudio($content){
        $pattern="/<div(\s+)class=\"vms-audio\"([\s\S]+)<div(\s+)id=\"(\S+)\">(\s+)<br(\s+)\/>(\s+)<\/div>(\s+)<\/div>/";;
        if(preg_match($pattern,$content,$matchs)) {
            $vms_video = AdminController::playVmsAudio($matchs[4]);
            $replace = "<div$1class=\"play-vms-audio\"$2<div$3id=\"$4\">" . $vms_video . "<br$6/>$7</div>$8</div>";
            return preg_replace($pattern, $replace, $content);
        }
        return $content;
    }
    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 分页函数
     *
     * @param $num 信息总数
     * @param $curr_page 当前分页
     * @param $perpage 每页显示数
     * @param $urlrule URL规则
     * @param $array 需要传递的数组，用于增加额外的方法
     * @return 分页
     */
    private function pages($num, $curr_page, $perpage = 20, $urlrule = '', $array = array(),$setpages = 10) {

        if(defined('URLRULE') && $urlrule == '') {
            $urlrule = URLRULE;
            $array = $GLOBALS['URL_ARRAY'];
        } elseif($urlrule == '') {
            $urlrule = $this->url_par('page={$page}');
        }
//        $tid=$_GET['tid'];
//        if($tid){
            $urls='&';
            //$array=array('tid'=>$tid);
//        }else{
//            $urls='';
//        }
        $multipage = '';
        if($num > $perpage) {
            $page = $setpages+1;
            $offset = ceil($setpages/2-1);
            $pages = ceil($num / $perpage);
            if (defined('IN_ADMIN') && !defined('PAGES')) define('PAGES', $pages);
            $from = $curr_page - $offset;
            $to = $curr_page + $offset;
            $more = 0;
            if($page >= $pages) {
                $from = 2;
                $to = $pages-1;
            } else {
                if($from <= 1) {
                    $to = $page-1;
                    $from = 2;
                }  elseif($to >= $pages) {
                    $from = $pages-($page-2);
                    $to = $pages-1;
                }
                $more = 1;
            }
            $multipage .= "";
            //#zhaoxiaokang
            #2015年8月19日18:01:38
            //课程页分页显示过多
            if($setpages == 10)
            {
                $visualNum = 6;
                $visualNum_back = 5;
            }
            else
            {
                $visualNum = $setpages/2;
                $visualNum_back = $setpages/2;
            }
            #
            if($curr_page>0) {
                if($curr_page==1){
                    $multipage .= ' <span class="a1">'.'上一页'.'<i></i>'.'</span>';
                }else{
                    $multipage .= ' <a href="'.$this->pageurl($urlrule, $curr_page-1, $array).$urls.'" class="a1">'.'上一页'.'<i></i>'.'</a>';
                }
                if($curr_page==1) {
                    $multipage .= ' <span>1</span>';
                } elseif($curr_page>$visualNum && $more) {
                    $multipage .= ' <a href="'.$this->pageurl($urlrule, 1, $array).$urls.'">1</a><span class=pagedot>...</span>';
                } else {
                    $multipage .= ' <a href="'.$this->pageurl($urlrule, 1, $array).$urls.'">1</a>';
                }
            }
            for($i = $from; $i <= $to; $i++) {
                if($i != $curr_page) {
                    $multipage .= ' <a href="'.$this->pageurl($urlrule, $i, $array).$urls.'">'.$i.'</a>';
                } else {
                    $multipage .= ' <span>'.$i.'</span>';
                }
            }
            if($curr_page<$pages) {
                if($curr_page<$pages-$visualNum_back && $more) {
                    $multipage .= ' <span class=pagedot>...</span> <a href="'.$this->pageurl($urlrule, $pages, $array).$urls.'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1, $array).$urls.'" class="a2">'.'下一页'.'<i></i>'.'</a>';
                } else {
                    $multipage .= ' <a href="'.$this->pageurl($urlrule, $pages, $array).$urls.'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1, $array).$urls.'" class="a2">'.'下一页'.'<i></i>'.'</a>';
                }
            } elseif($curr_page==$pages) {
                $multipage .= ' <span>'.$pages.'</span> <span  class="a2">'.'下一页'.'<i></i>'.'</span>';
            } else {
                $multipage .= ' <a href="'.$this->pageurl($urlrule, $pages, $array).'">'.$pages.'</a> <a href="'.$this->pageurl($urlrule, $curr_page+1, $array).'" class="a2">'.'下一页'.'<i></i>'.'</a>';
            }
        }
        return $multipage;
    }
    /**
     * 返回分页路径
     *
     * @param $urlrule 分页规则
     * @param $page 当前页
     * @param $array 需要传递的数组，用于增加额外的方法
     * @return 完整的URL路径
     */
private function pageurl($urlrule, $page, $array = array()) {
        if(strpos($urlrule, '~')) {
            $urlrules = explode('~', $urlrule);
            $urlrule = $page < 2 ? $urlrules[0] : $urlrules[1];
        }
        $findme = array('{$page}');
        $replaceme = array($page);
        if (is_array($array)) foreach ($array as $k=>$v) {
            $findme[] = '{$'.$k.'}';
            $replaceme[] = $v;
        }
        $url = str_replace($findme, $replaceme, $urlrule);
        $url = str_replace(array('http://','//','~'), array('~','/','http://'), $url);
        return $url;
    }

    /**
     * URL路径解析，pages 函数的辅助函数
     *
     * @param $par 传入需要解析的变量 默认为，page={$page}
     * @param $url URL地址
     * @return URL
     */
    function url_par($par, $url = '') {
        if($url == '') $url = Yii::$app->request->getUrl();
        $pos = strpos($url, '?');
        if($pos === false) {
            $url .= '?'.$par;
        } else {
            $querystring = substr(strstr($url, '?'), 1);
            parse_str($querystring, $pars);
            $query_array = array();
            foreach($pars as $k=>$v) {
                if($k != 'page') $query_array[$k] = $v;
            }
            $querystring = http_build_query($query_array).'&'.$par;
            $url = substr($url, 0, $pos).'?'.$querystring;
        }
        return $url;
    }

}
