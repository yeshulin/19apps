<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\site\controllers;

use common\helpers\SEO;
use frontend\controllers\WebController;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class GoodsController extends WebController
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
     * 商品详情页
     * */
    public function actionIndex()
    {
        $client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
        ]);
        $id = Yii::$app->request->get('id');
        $parArr = [
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
                SEO::setSEO($data['goods_name']);
                return $this->render("//goods/view", ['data' => $data]);
            } else {
                echo $response->data['error'];
            }
        }

    }
}
