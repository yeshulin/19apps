<?php
namespace frontend\modules\site\Lib;

use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class Helper
{
    public static function hasCourse($courseid)
    {
        $user = Yii::$app->user->identity;
        if (!empty($user)) {
            $client = new Client([
                'transport' => 'yii\httpclient\CurlTransport',
            ]);
            $parArr = [
                'userid' => Yii::$app->user->id,
                'courseid' => $courseid,
            ];
            $response = $client->createRequest()
                ->setFormat("json")
                ->setMethod('post')
                ->setUrl(Yii::$app->request->hostInfo . Url::to(['/api/order/hascourse']))
                ->setData($parArr)
                ->send();

            if ($response->isOk) {
                $res = $response->data;
                if ($res['code'] == '0000' && $res['data'][0] > 0) {
                    return true;
                }
            }
        }
        return false;
    }
}
