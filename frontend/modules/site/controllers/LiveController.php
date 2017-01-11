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

class LiveController extends WebController
{
    private $liveurl;
    private $goodurl;

    public function init()
    {
        parent::init();
        $baseApiUrl = Yii::$app->request->hostInfo;
        $this->liveurl = $baseApiUrl . Url::to(['/api/live/roomshow']);
        $this->goodurl = $baseApiUrl . Url::to(['/api/goods']);
    }

    public function actionIndex()
    {
        $this->layout = "//main_home";
        $data = [];
        return $this->render("//live/index", ['list' => $data]);
    }

    public function actionView()
    {
        $type = Yii::$app->request->get('type');
        $allow = ['class', 'school', 'platform'];
        if (!in_array($type, $allow)) {
            echo "错误的类型";
            return;
        }

        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        $id = Yii::$app->request->get('id');
        $parArr = [
            'method' => 'live',
            'type' => 'list',
        ];
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->goodurl)
            ->setData($parArr)
            ->send();
        if ($response->isOk) {
            if ($response->data['code'] == "0000") {
                $data = $response->data['data'];
                foreach ($data['data'] as $key => $value) {
                    if($value['live']['type'] == $type){
                        $request[] = $value;
                    }
                }
            } else {
                echo $response->data['error'];
            }
        }

        //var_dump($request);

        $this->layout = "//main_home";
        return $this->render("//live/view_" . $type, ['list' => $request]);
    }

    /*
     * 视频播放页面
     * */
    public function actionPlay()
    {
        $this->layout = "//other";
        $roomId = yii::$app->request->get("roomid");
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        $parArr = [
            'roomId' => $roomId,
            'sessionId' => 0,
        ];
        $response = $client->createRequest()
            ->setFormat("json")
            ->setMethod('post')
            ->setUrl($this->liveurl)
            ->setData($parArr)
            ->send();
        if ($response->isOk) {
            $data = $response->data['data'];
            foreach($data['channel'] as $key=>$val){
                if($val['channel_type']=="output"){
                    $data['outStreamUrl'] = $val['output'];
                }
            }
            return $this->render("//live/play", ['data' =>$data]);
        }
    }

}
