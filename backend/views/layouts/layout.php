<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\MainAsset;
use yii\helpers\Html;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
