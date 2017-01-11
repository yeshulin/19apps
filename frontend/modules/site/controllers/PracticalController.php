<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\site\controllers;

use Yii;
use frontend\controllers\WebController;
use yii\httpclient\Client;
use yii\helpers\Url;

class PracticalController extends WebController
{
    private $goodurl;
    public $layout = "//main_home";

    public function init(){
        parent::init();
        $this->goodurl = $this->apicollege.Url::to(['/api/goods']);
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
        $data['data'] = [];
        return $this->render("//practical/index",['list'=>$data['data']]);
    }
    /*
     * 课程详情页
     * */
    public function actionView(){
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
        $parArr = [
            'method'=>'view',
            'id'=>'10',
            'type'=>'1'
        ];
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl( $this->goodurl)
            ->setData($parArr)
            ->send();
        if ($response->isOk) {
            $data = $response->data['data'];
        }
        return  $this->render("//practical/view",['data'=>$data]);

    }
}