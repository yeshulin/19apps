<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\LoginAsset;
use common\widgets\Alert;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <?php        
        $this->registerCssFile('@web/mlv/css/amazeui.min.css');        
        $this->registerCssFile('@web/mlv/css/member.css');
    ?>
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
    <title><?= Html::encode(Yii::$app->params['web-title']) ?></title>
    <meta name="keywords" content="<?= Html::encode(Yii::$app->params['web-keywords']) ?>">
    <meta name="description" content="<?= Html::encode(Yii::$app->params['web-description']) ?>">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
  
<header>
<?php echo $this->render('header');?>
</header>
<div class="content-main-box"><?= $content ?>
</div>

<footer class="footer">
    <?php echo $this->render('footer');?>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
