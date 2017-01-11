<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ContentCatlog */

$this->title = Yii::t('backend','createContentCatlog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','ContentCatlog'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-catlog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
