<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Goods;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品';
$this->params['breadcrumbs'][] = $this->title;

$goods_type = Goods::dropDown('type');
unset($goods_type[Goods::TYPE_MERGE]);
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="goods-search">

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'fieldConfig'=>[
                'options'=>[
                    'style'=>'float: left;with: 200px',
                ]
            ]
        ]); ?>
        <?= $form->field($searchModel, 'goods_name') ?>

        <?= $form->field($searchModel, 'keywords') ?>

        <?php  echo $form->field($searchModel, 'type')->dropDownList($goods_type) ?>

        <div class="form-group" style="padding-top: 22px">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div style="clear: both"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'goods_id',
            'goods_name',
//            'keywords',
//            'goods_thumb',
            'price',
             'money',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Goods::dropDown('type', $model->type);
                },
            ],
            // 'association_id',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Goods::dropDown('status', $model->status);
                },
            ],
             'create_at:datetime',
             'update_at:datetime',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php
        $this->registerJs('
            $("#w1 tbody tr").mousemove(function(){
                $(this).css(\'background-color\', \'#DDD\');
            }).mouseout(function(){
                $(this).css(\'background-color\', \'\');
            }).on("click",function(){
                var iputObj = parent.$("#merge-layer_notice").find("input");
                var datKaey = $(this).attr("data-key");
                var value = iputObj.val();
                if (value !== \'\')
                {
                    datKaey = value+\',\'+datKaey;
                }
                iputObj.val(datKaey);
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            })
        ', \yii\web\View::POS_END);
    ?>
</div>
