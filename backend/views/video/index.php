<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('创建视频', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('同步VMS视频', ['class' => 'btn btn-success', 'id'=>'sync-vms']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'videoid',
            'vmsid',
//            'videoname',
            [
                "attribute"=>"videoname",
                'format' => 'raw',
                'value'=> function ($model)
                {
                    return Html::a($model->videoname, null, ['onclick'=>'Play('.$model->videoid.')']);
                }
            ],
            'time',
//            'thumb',
             'create_at:datetime',
            // 'update_at',
            // 'userid',
            // 'usertype',
//             'type',
            [
                "attribute"=>"type",
                "value"=>function($model){
                    return $model::dropDown("type",$model->type);
                },
                'filter'=>$searchModel::dropDown('type'),
            ],
//             'status',
            [
                "attribute"=>"status",
                "value"=>function($model){
                    return $model::dropDown("status",$model->status);
                },
                "filter"=>$searchModel::dropDown("status")
            ],
            // 'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php $this->registerJs('
    $("#sync-vms").on("click", function(){
        layer.open({
            type: 2,
            title: \'ｖｍｓ视频同步\',
            shadeClose: true,
            shade: 0.8,
//            area: [\'50% \', \'60% \'],
            content: \''.Url::to(['video/sync-vms-video']).'\' //iframe的url
        });
    })
    ', \yii\web\View::POS_END)?>
</div>
