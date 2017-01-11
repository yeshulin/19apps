<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ActivationlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->title = Yii::t('backend', 'Activationlog');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activationlog-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Activation'),['/activation/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'Activationlog'), ['/activationlog/index'], ['class' => 'btn btn-success']) ?>
        <!--        --><?//= Html::a(Yii::t('backend', 'ActivationCatlog'), ['/activation-catlog/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Activationlog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'activ_code',
            'userid',
//            'crated_at:datetime',
            [
                "attribute"=>"created_at",
                "format"=>"datetime",
                "filter"=>""
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>"{view}"
            ],
        ],
    ]); ?>
</div>
