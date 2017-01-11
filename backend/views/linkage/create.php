<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Linkage */

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label'=>'联动数据列表','url' => \yii\helpers\Url::to(['linkage/index'])];

if (!empty($breadcrumbs)) {
    $this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $breadcrumbs);
}
else {
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="linkage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
