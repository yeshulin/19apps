<?php

namespace frontend\controllers\api;

use yii\filters\VerbFilter;
use common\models\Contactus;

class AboutController extends ApiController
{
    public $enableCsrfValidation = false; //关闭csrf验证
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

    public function init()
    {
        parent::init();
    }

    public function actionContactus()
    {
        $result = Contactus::find()->where(['status'=>1])->orderBy(['sort' => SORT_DESC])->asArray()->all();
        $this->setReturn("0000", "success", $result);    
    }

}
