<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Practical */

$this->title = $model->practicalid;
$this->params['breadcrumbs'][] = ['label' => '实训列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practical-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->practicalid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->practicalid], [
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
            'practicalid',
            'practical_name',
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
//            'brief',
//            'type',
            [
                'attribute' => 'type',
                'value' =>  $model::dropDown('type', $model->type),
            ],
            'link',
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
