<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MyliveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Mylive');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylive-index">

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

            'live_id',
            'live_name',
            'userid',
//            'tongdao',
//            'qiehuangtai',
            // 'liuliangbao',
//             'roomid',
            [
                'attribute'=>'roomid',
                'value'=>function($model){
                    return $model->roomid?$model->roomid:'';
                },
                'contentOptions'=>function($model){
                    return [
                         'onclick'=>'ShowElement(this,'.$model->goods_id.',\''.\yii\helpers\Url::to(['mylive/code']).'\','.$model->live_id.','.$model->totals.',0,1,'.$model->userid.')'
                    ];
                }
            ],
            // 'created_at',
            // 'updated_at',
             'status:serverstatus',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{update}{view}&nbsp;{delete}"
            ],
        ],
    ]); ?>
</div>
