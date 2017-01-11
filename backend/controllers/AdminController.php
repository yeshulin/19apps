<?php

namespace backend\controllers;
use Yii;
use \yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\httpclient\Client;

class AdminController extends Controller
{
    public function beforeAction($event)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
//        $controller = $event->controller->id;
//        $action = $event->controller->action->id;
//        $access = $controller."::".$action;

        $access = str_replace('/', '::', Yii::$app->requestedRoute);

        $PermissionsByUser = array_keys(Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id));

        if (in_array('*::*', $PermissionsByUser) || in_array(substr($access, 0, strrpos($access, '::')).'::*', $PermissionsByUser)) {
            return true;
        }

        if (!Yii::$app->user->can($access)) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        return true;
    }
    /**
     *  VMS视频播放
     */
    public function playVmsVideo($vmsid){
        $data = self::getVmsVideo($vmsid);
        $vms_video = str_replace(array('<![CDATA[', ']]>'), '', $data['video'][0]['playerCodeList'][0]['playerCode']);
        return $vms_video;
    }

    public function playVmsAudio($vmsid){
        $data = self::getVmsAudio($vmsid);
        $vms_video = str_replace(array('<![CDATA[', ']]>'), '', $data['audio'][0]['playerCodeList'][0]['playerCode']);
        return $vms_video;
    }

    /**
     *  获取VMS视频信息
     */
    protected function getVmsVideo($vmsid){
//        $vms_token = pc_base::load_config('system', 'vms_token');
        $vms_token = Yii::$app->params['vms_token'];
        $url = Yii::$app->params['vms_path'] . "?method=getVideoById&partnerToken=" . $vms_token . "&dataType=json&videoId=" . $vmsid;
        $response = self::curl_post($url);
//        $data = json_decode($response, true);
        return $response;
    }
    protected function getVmsAudio($vmsid){
//        $vms_token = pc_base::load_config('system', 'vms_token');
        $vms_token = Yii::$app->params['vms_token'];
        $url = Yii::$app->params['vms_path'] . "?method=getAudioById&partnerToken=" . $vms_token . "&dataType=json&videoId=" . $vmsid;
        $response = self::curl_post($url);
//        $data = json_decode($response, true);
        return $response;
    }
    protected function curl_post($url,$config=[]){
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl( $url )
            ->setData($config)
            ->send();
        if ($response->isOk) {
            return $response->data;
        }
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
////        curl_setopt($ch, CURLOPT_POSTFIELDS);
//        $response = curl_exec($ch);
//        curl_close($ch);
//        return $response;
    }
}
