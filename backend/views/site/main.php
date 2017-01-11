<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;
use backend\models\Menu;
use common\models\Member;

$this->title = 'My Yii Application';

//php获取今日开始时间戳和结束时间戳
$beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
$endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
//php获取昨日起始时间戳和结束时间戳
$beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
$endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
//php获取上周起始时间戳和结束时间戳
$beginLastweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 7, date('Y'));
$endLastweek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));
//php获取本月起始时间戳和结束时间戳
$beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
$endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));

?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>个人信息</h5>
                </div>
                <div class="ibox-content">
                    <p>您好，<?= Yii::$app->user->identity->username?></p>
                    <p>所属角色：<?= key(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))?></p>
                    <p>上次登录时间：<?= date("Y-m-d H:i:s", Yii::$app->user->identity->end_login_at)?></p>
                    <p>上次登录IP：<?= Yii::$app->user->identity->end_login_ip?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-8">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>数据概览</h5>
                </div>
                <div class="ibox-content" style="height: 148px;">
                    <p>总注册用户数<font
                            color="red"><?= Member::find()->where(['status' => Member::STATUS_ACTIVE])->count() ?></font>人，
                        上月注册<font
                            color="red"><?= Member::find()->where(['status' => Member::STATUS_ACTIVE])->andWhere(['BETWEEN', 'created_at', $beginThismonth, $endThismonth])->count() ?></font>人，
                        上周注册<font
                            color="red"><?= Member::find()->where(['status' => Member::STATUS_ACTIVE])->andWhere(['BETWEEN', 'created_at', $beginLastweek, $endLastweek])->count() ?></font>人，
                        昨日注册<font
                            color="red"><?= Member::find()->where(['status' => Member::STATUS_ACTIVE])->andWhere(['BETWEEN', 'created_at', $beginYesterday, $endYesterday])->count() ?></font>人，
                        今日注册<font
                            color="red"><?= Member::find()->where(['status' => Member::STATUS_ACTIVE])->andWhere(['BETWEEN', 'created_at', $beginToday, $endToday])->count() ?></font>人。
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>研发团队</h5>
                </div>
                <div class="ibox-content">
                    <p> 版权所有：成都索贝数码科技股份有限公司</p>
                    <p>总 策 划：余军</p>
                    <p>
                        开发与支持团队：叶树林、熊乾宏、刘俊涛、黄玻、赵小康
                    </p>
                    <p>
                        UI 设计：饶丽丹、李文娟、段奇兵
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>