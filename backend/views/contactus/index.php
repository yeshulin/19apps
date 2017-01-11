<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Contactus;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Contactus */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '联系我们';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'city',
                'value' => function ($model) {
                    return Contactus::dropDown('city', $model->city); //主要通过此种方式实现
                },
                "filter" => Contactus::dropDown('city'),
            ],
            'address',
            'phone',
            'fax',
            'sort',
            // 'zipcode',
            // 'created_at',
            // 'updated_at',
            // 'status',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Contactus::dropDown('status', $model->status); //主要通过此种方式实现
                },
                "filter" => Contactus::dropDown('status'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
