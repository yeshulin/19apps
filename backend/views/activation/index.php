<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ActivationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Activation');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activation-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Activation'), ['/activation/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'Activationlog'), ['/activationlog/index'], ['class' => 'btn btn-success']) ?>
<!--        --><?//= Html::a(Yii::t('backend', 'ActivationCatlog'), ['/activation-catlog/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'createActivation'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $formatter = new \common\widgets\Formatter();
//    $formatter->datetimeFormat="short";
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => $formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'activid',
            'activ_code',
            'lot_number',
//            'type:ActiveType',
//            [
//                'attribute' => 'type',
//                'label' => '激活码类型',
//                'format' => 'ActiveType',
//                'value' => function ($model) {
//                    return $model->type;
//                },
//                'filter' => \backend\models\ActivationCatlog::getList(),
//                'headerOptions' => ['width' => '150'],
//            ],
//            'make_time:datetime',
            // 'userid',
            // 'username',
            // 'm_userid',
            // 'm_username',
            // 'start_time:datetime',
//             'end_time:datetime',
            [
                'attribute' => 'make_time',
                'format' => 'datetime2',
                "filter"=>"",
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'id' => 'header-make_time',
                ],
            ],
            [
                'attribute' => 'end_time',
                'format' => 'datetime2',
                "filter"=>"",
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'id' => 'header-end_time',
                ],
            ],
            'effective:YYMM',
//            'status:activeStatus',returnActiveStatus
            [
                'attribute' => 'status',
                'format' => 'activeStatus',
                'filter' => $formatter->returnActiveStatus(),
            ],
            // 'product_id',
            // 'videoplay_id',
            // 'm_type',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
