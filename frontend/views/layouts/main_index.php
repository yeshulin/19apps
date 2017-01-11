<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
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

        <div class="clearfix" style="width: 1200px;margin: auto;">
            <!--左侧栏-->           
            <!--内容-->            
            <?= $content ?>
            
        </div>

<footer class="footer">
    <?php echo $this->render('footer');?>
</footer>
<div style="display:none" id="cnzztongjie"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260196398'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1260196398' type='text/javascript'%3E%3C/script%3E"));</script></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
