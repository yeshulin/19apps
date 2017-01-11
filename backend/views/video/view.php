<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Video */

$this->title = $model->videoid;
$this->params['breadcrumbs'][] = ['label' => '视频列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->videoid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->videoid], [
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
            'videoid',
            'vmsid',
            'videoname',
            'time',
            'thumb',
            'create_at:datetime',
            'update_at:datetime',
            'userid',
            'usertype',
            'type',
//            'status',
            [
                "attribute"=>"status",
                "value"=> \common\models\Video::dropDown("status",$model->status)
            ],
            'order',
        ],
    ]) ?>

</div>
