<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Linkage */

$this->title = $model->name;
if (!empty($breadcrumbs)) {
    $this->params['breadcrumbs'][] = ['label'=>'联动数据列表','url' => \yii\helpers\Url::to(['linkage/index'])];
    $this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $breadcrumbs);
}
else {
    $this->params['breadcrumbs'][] = $this->title;
}

?>
<div class="linkage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'parentid',
            'order',
            'description',
        ],
    ]) ?>

</div>
