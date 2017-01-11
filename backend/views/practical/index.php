<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Practical;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PracticalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '实训列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practical-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建实训', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'practicalid',
            'practical_name',
            'brief',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return Practical::dropDown('type', $model->type);
                },
                "filter" => Practical::dropDown('type'),
            ],
//            'type',
//            'link',
             'order',
//             'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Practical::dropDown('status', $model->status);
                },
                "filter" => Practical::dropDown('status'),
            ],
             'create_at:datetime',
             'update_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
