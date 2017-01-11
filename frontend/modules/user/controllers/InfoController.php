<?php
/**
 * User: yeshulin
 * Date: 2016/7/29
 * Time: 14:29
 */

namespace frontend\modules\user\controllers;

use common\helpers\SEO;
use Yii;
use frontend\controllers\WebController;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\helpers\Url;
use frontend\models\Organ;

class InfoController extends WebController
{
    public $layout = "@app/views/layouts/user";

    public function init()
    {
        parent::init();
        $user = Yii::$app->user->identity;
        if (empty($user)) {
            $this->redirect(['/auth/login']);
        }
    }

    public function actionEdit()
    {
//        var_dump($response);
//        exit;
        return $this->render('//user/edit');
//        return $this->redirect(['show', 'username' => \Yii::$app->user->identity->username]);
    }

    public function actionPwd()
    {
//        var_dump($response);
//        exit;
        return $this->render('//user/pwd');
//        return $this->redirect(['show', 'username' => \Yii::$app->user->identity->username]);
    }

    public function actionRenzheng($type=0)
    {
        $uid = Yii::$app->user->id;
        $this->layout = "@app/views/layouts/main";
        $types = [
            "1", "2", "3"
        ];
        if(!in_array($type, $types)){
            $level=0;
            (Organ::findByUseridExt($uid, 3) && $level=3) || (Organ::findByUseridExt($uid, 2) && $level=2) || (Organ::findByUseridExt($uid, 1) && $level=1);
            return $this->render('//user/renzhengInfo',[
                'level'=>Organ::getLevel($level)
            ]);
        }
        $organ = Organ::findByUserid($uid, $type);
        $info = $organ ? $organ->toArray() : '';
        SEO::setSEO("认证申请");
//        if ($organ && $organ->status == 1) {//审核成功
        if ($organ) {//
            switch ($organ->usertype) {
                case 1:
                    SEO::setSEO("个人认证");
                    return $this->render('//user/renzhengPerson', [
                        'info' => $info,
                        'type' => $type
                    ]);
                    break;
                case 2:
                case 3:
                    SEO::setSEO("校企认证");
                    return $this->render('//user/renzhengOrgan', [
                        'info' => $info,
                        'type' => $type
                    ]);
                    break;
                default:
                    return $this->render('//user/renzhengApply', [
                        'info' => $info,
                        'type' => $type
                    ]);
                    break;
            }
        }
        if ($type != 1 && empty($organ)) {

            $infoPerson = Organ::findByUserid($uid, 1);
            if (!empty($infoPerson)) $info = $infoPerson->toArray();
        }
        return $this->render('//user/renzhengApply', [
            'info' => $info,
            'type' => $type
        ]);
    }
    /* public function actionOrgan(){
        return $this->render('//user/renzhengOrgan');
    }
    public function actionPerson(){
        return $this->render('//user/renzhengPerson');
    }
    public function actionApply(){
        return $this->render('//user/renzhengApply');
    } */
}