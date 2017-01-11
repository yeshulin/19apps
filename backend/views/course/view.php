<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Course */
?>
<!--    <p>-->
<?//= Html::a('更新', ['update', 'id' => $model->course_id], ['class' => 'btn btn-primary']) ?>
<?//= Html::a('删除', ['delete', 'id' => $model->course_id], [
//    'class' => 'btn btn-danger',
//    'data' => [
//        'confirm' => 'Are you sure you want to delete this item?',
//        'method' => 'post',
//    ],
//]) ?>
<!--    </p>-->

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'course_id',
        'course_name',
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
            'attribute' => 'description',
            'format'=> 'raw',
            'value' =>  \backend\widgets\Kindedtior::widget([
                'id'=>'description',
                'name'=>'description',
                'value'=> $model->description,
                'toolbars'=>'null',
                'kindeditor'=>[
                    'readonlyMode' => 'true',
                ]
            ]),
        ],
//        'brief',
//        'description:ntext',
        'authorid',
        [
            'attribute' => 'auth_count_time',
            'value' =>  ($model->auth_count_time/2592000).'月',
        ],
//        'thumb',
        'type',
        'userid',
        [
            'attribute' => 'status',
            'value' =>  $model::dropDown('status', $model->status),
        ],
        'create_at:datetime',
        'update_at:datetime',
    ],
]) ?>