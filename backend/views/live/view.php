<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Live */

$this->title = $model->liveid;
$this->params['breadcrumbs'][] = ['label' => '直播列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->liveid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->liveid], [
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
            'liveid',
            'live_name',
//            'brief',
            [
                'attribute' => 'thumb',
                'format'=> 'Html',
                'value' =>  Html::img($model->thumb, ['width'=>'260px', 'height'=>'150px']),
            ],
            [
                'attribute' => 'brief',
                'format'=> 'raw',
                'value' =>  \backend\widgets\Kindedtior::widget([
                    'id'=>'brief',
                    'name'=>'brief',
                    'value'=> $model->brief,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true',
                    ]
                ]),
            ],
            [
                'attribute' => 'overview',
                'format'=> 'raw',
                'value' =>  \backend\widgets\Kindedtior::widget([
                    'id'=>'overview',
                    'name'=>'overview',
                    'value'=> $model->overview,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true',
                    ]
                ]),
            ],
            [
                'attribute' => 'flow',
                'format'=> 'raw',
                'value' =>  \backend\widgets\Kindedtior::widget([
                    'id'=>'flow',
                    'name'=>'flow',
                    'value'=> $model->flow,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true',
                    ]
                ]),
            ],
            [
                'attribute' => 'scene',
                'format'=> 'raw',
                'value' =>  \backend\widgets\Kindedtior::widget([
                    'id'=>'scene',
                    'name'=>'scene',
                    'value'=> $model->scene,
                    'toolbars'=>'null',
                    'kindeditor'=>[
                        'readonlyMode' => 'true',
                    ]
                ]),
            ],
//            'overview:ntext',
//            'flow:ntext',
//            'scene:ntext',
            'order',
            [
                'attribute' => 'status',
                'value' =>  $model::dropDown('status', $model->status),
            ],
            'create_at:datetime',
            'update_at:datetime',
        ],
    ]) ?>

</div>
