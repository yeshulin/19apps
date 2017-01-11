<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MypracticalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Mypractical');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mypractical-index">

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

            'practical_id',
            'practical_name',
            'totals',
            'userid',
//            'created_at',
            // 'updated_at',
//             'lab_code',
            [
                'attribute'=>'practical_code',
                'value'=>function($model){
                    return $model->practical_code?$model->practical_code:'';
                },
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowElement(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mypractical/code']).'\','.$model->practical_id.','.$model->totals.',1,1,'.$model->userid.')'
                    ];
                }
            ],
            [
                'attribute'=>'practical_url',
                'value'=>function($model){
                    return $model->practical_url?$model->practical_url:'';
                },
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowElement(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mypractical/url']).'\','.$model->practical_id.','.$model->totals.',0,0,0)'
                    ];
                }
            ],
            [
                'attribute'=>'begin_time',
                'value'=>function($model){
                    return $model->begin_time?date("Y/m/d H:i:s",$model->begin_time):'';
                },
                'contentOptions'=>function($model){
                    return [
                        'onclick'=>'ShowTime(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mypractical/begintime']).'\','.$model->practical_id.','.$model->totals.',0,0)'
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
                        'onclick'=>'ShowTime(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mypractical/endtime']).'\','.$model->practical_id.','.$model->totals.',0,0)'
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
