<?php
namespace frontend\controllers\api;

use common\models\Advertisement;
use Yii;
use yii\filters\VerbFilter;

class AdvertisementController extends ApiController
{
    public $response;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'view' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    public function actionGet()
    {
        $id = Yii::$app->request->get('id');
        if (empty($id)) {
            $this->setReturn("0003", "failed", "", "参数错误");
            return;
        }

        $result = Advertisement::find()->where(['id' => $id, 'status' => 1])->asArray()->one();
        if (!$result) {
            $this->setReturn("0003", "failed", "", "没有找到数据");
            return;
        }

        $result['content'] = unserialize($result['content']);
        $this->setReturn("0000", "success", $result);

    }

}
