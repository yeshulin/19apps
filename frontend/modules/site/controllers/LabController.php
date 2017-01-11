<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/12
 * Time: 14:03
 */

namespace frontend\modules\site\controllers;


use frontend\controllers\WebController;

class LabController extends WebController
{
    public $layout = "//main_home";

    public function actionIndex()
    {
        $data = [];
        return $this->render("//lab/index", ['list' => $data]);
    }
}