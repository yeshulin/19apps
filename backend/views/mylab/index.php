<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MylabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Mylab');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('backend','create'), ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?php $formatter = new \common\widgets\Formatter();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter'=>$formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'lab_id',
            'lab_name',
            'totals',
            'userid',
//            'created_at',
            // 'updated_at',
//             'lab_code',
            [
                'attribute'=>'lab_code',
                'value'=>function($model){
                    return $model->lab_code?$model->lab_code:'';
                },
                'contentOptions'=>function($model){
                    return [
                         'onclick'=>'ShowElement(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mylab/code']).'\','.$model->lab_id.','.$model->totals.',1,1,'.$model->userid.')'
                    ];
                }
            ],
            [
                'attribute'=>'lab_url',
                'value'=>function($model){
                    return $model->lab_url?$model->lab_url:'';
                },
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowElement(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mylab/url']).'\','.$model->lab_id.','.$model->totals.',0,0,0)'
                    ];
                }
            ],
            [
                'attribute'=>'begin_time',
                'value'=>function($model){
                    return $model->begin_time?date("Y/m/d H:i:s",$model->begin_time):'';
                },
                'headerOptions'=>[
                    "class"=>"bb"
                ],
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowTime(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mylab/begintime']).'\','.$model->lab_id.','.$model->totals.',0,0)',
                        "class"=>"timepick"
                    ];
                }
            ],
            [
                'attribute'=>'end_time',
                'value'=>function($model){
                    return $model->end_time?date("Y/m/d H:i:s",$model->end_time):'';
                },
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowTime(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mylab/endtime']).'\','.$model->lab_id.','.$model->totals.',0,0)',
                        "class"=>"timepick"
                    ];
                }
            ],
             'status:serverstatus',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view}&nbsp;{delete}"
            ],
        ],
    ]); ?>
</div>
