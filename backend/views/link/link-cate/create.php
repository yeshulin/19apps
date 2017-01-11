<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LinkCate */

$this->title = '创建分类';
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['/link/index']];
$this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-cate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
