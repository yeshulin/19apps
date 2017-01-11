<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CertificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '创建';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certification-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'certificationid',
            'certification_name',
//            'examtype',
//            'studyway',
//            'object',
//             'brief:ntext',
//             'people:ntext',
             'order',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model::dropDown('status', $model->status);
                },
                'filter'=>  $searchModel::dropDown('status'),
            ],
//             'status',
             'create_at:datetime',
             'update_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
