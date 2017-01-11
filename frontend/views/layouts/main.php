<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
    <title><?= Html::encode(Yii::$app->params['web-title']) ?></title>
    <meta name="keywords" content="<?= Html::encode(Yii::$app->params['web-keywords']) ?>">
    <meta name="description" content="<?= Html::encode(Yii::$app->params['web-description']) ?>">
    <?php $this->head() ?>
    

</head>
<body>
<?php $this->beginBody() ?>
<!--网站头部-->
<header>
<?php echo $this->render('header');?>
</header>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <!--用户顶部-->
        <div class="bread-crumbs">
            <div>
                <a href="<?=Url::to(['/'])?>">首页</a>
                <span>&nbsp;&gt;&nbsp;</span>
                <a href="<?=Url::to(['/user'])?>">个人中心</a>
            </div>
        </div>
        <div class="clearfix content-main-box" style="width: 1200px;margin: auto;">
            <!--左侧栏-->           
            <!--内容-->

            <?= $content ?>
            
            
        </div>

<footer class="footer">
    <?php echo $this->render('footer');?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
