<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class CeshiController extends Controller
{


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionHash()
    {
       var_dump(\common\helpers\Encrypt::sys_auth(time(),"ENCODE","ChinaMCloud@2016"));
    }


}
