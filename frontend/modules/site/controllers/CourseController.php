<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\site\controllers;

use frontend\controllers\WebController;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class CourseController extends WebController
{
    private $goodurl;
    public $layout = "//main_home";

    public function init()
    {
        parent::init();
        $baseApiUrl = Yii::$app->request->hostInfo;
        $this->goodurl = $baseApiUrl . Url::to(['/api/goods']);
    }
    /*
     * 课程首页
     * */
    public function actionIndex()
    {
//        $client = new Client([
        //            'transport' => 'yii\httpclient\CurlTransport'
        //        ]);
        //        $parArr = [
        //            'method'=>'list',
        //            'pagesize'=>'10',
        //            'size'=>'1',
        //            'type'=>'1'
        //        ];
        //        $response = $client->createRequest()
        //            ->setMethod('f')
        //            ->setUrl( $this->goodurl)
        //            ->setData($parArr)
        //            ->send();
        //
        //        if ($response->isOk) {
        //            $data = $response->data['data'];
        //        }

        $data = [];
        return $this->render("//course/index", ['list' => $data]);
    }

    public function actionList()
    {
        $config = Yii::$app->request->get('config', null);
        if (empty($config))
        {
            $config = null;
        }

        $data = Yii::$app->request->get();
//        var_dump($data);
        return $this->render("//course/list", ['list' => $data]);
    }

    public function actionPlay($id)
    {
        $data = [];
        $user = Yii::$app->user->identity;

        if (empty($user)) {
            $this->redirect(['/auth/login']);
        }

        return $this->render("//course/play", [
            'data' => $data,
            'id'=> $id,
            'user' => $user
        ]);
    }

    /*
     * 课程详情页
     * */
    public function actionView()
    {
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        $id = Yii::$app->request->get('id');
        $parArr = [
            'method' => 'course',
            'id' => $id,
            'type' => 'view',
        ];
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->goodurl)
            ->setData($parArr)
            ->send();
        if ($response->isOk) {
            if ($response->data['code'] == "0000") {
                $data = $response->data['data'];
                if($data['goodsAttr']){
                    foreach ($data['goodsAttr'] as $key => $value) {
                        $data['attrs'][$value['attrtype']][] = $value;
                    }
                }
                return $this->render("//course/view", ['data' => $data]);
            } else {
                echo $response->data['error'];
            }
        }

    }
}
