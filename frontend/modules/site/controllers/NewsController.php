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

class NewsController extends WebController
{
    private $newsurl;
    public $layout = "//main_home";

    public function init()
    {
        parent::init();
        $baseApiUrl = Yii::$app->request->hostInfo;
        $this->newsurl = $baseApiUrl . Url::to(['/api/content']);
    }
    /*
     * 新闻首页
     * */
    public function actionIndex()
    {

        $data = [];
        return $this->render("//news/index", ['list' => $data]);
    }

    /**
     * @return string
     */
    public function actionList()
    {
        $config = Yii::$app->request->get('config', null);
        if (empty($config))
        {
            $config = null;
        }

        $data = Yii::$app->request->get();
        return $this->render("//news/list", ['list' => $data]);
    }

    /*
     * 新闻详情页
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
