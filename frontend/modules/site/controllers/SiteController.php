<?php
/**
 * Created by PhpStorm.
 * User: IUOD
 * Date: 2016/8/16
 * Time: 18:43
 */

namespace frontend\modules\site\controllers;

use frontend\controllers\WebController;

class SiteController extends WebController
{
    public $layout = "//main_home";
    public function actionIndex()
    {
        $data = [];
        return $this->render("//site/index", ['list' => $data]);
    }

    /**
     * 联系我们
     * @return string
     */
    public function actionContact()
    {
        return $this->render("//site/contact");
    }

    /**
     * 简介
     * @return string
     */
    public function actionIntroduce()
    {
        return $this->render("//site/introduce");
    }

    public function actionError()
    {
        return $this->render('//site/error');
    }
}
