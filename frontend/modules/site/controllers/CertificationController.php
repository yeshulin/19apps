<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/15
 * Time: 10:27
 */

namespace frontend\modules\site\controllers;


use frontend\controllers\WebController;

class CertificationController extends WebController
{
    public $layout = "//main_home";

    public function actionIndex()
    {
        $data = [];
        return $this->render("//certification/index", ['list' => $data]);
    }
}