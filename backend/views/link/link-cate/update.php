<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LinkCate */

$this->title = '更新分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['/link/index']];
$this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->linkcatid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-cate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
