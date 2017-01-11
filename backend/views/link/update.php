<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = '更新友情链接: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->linkid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
