<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Contactus;


/* @var $this yii\web\View */
/* @var $model common\models\Contactus */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '联系我们', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactus-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'title',
            [
                'attribute' => 'city',
                'value'=>  Contactus::dropDown('city', $model->city),
            ],
            'address',
            'phone',
            'fax',
            'zipcode',
            'sort',
            [
                'attribute' => 'status',
                'value'=>  Contactus::dropDown('status', $model->status),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
