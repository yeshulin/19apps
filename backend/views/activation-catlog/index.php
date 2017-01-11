<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ActivationCatlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','ActivationCatlog');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activation-catlog-index">

    <p>
        <?= Html::a(Yii::t('backend','Activation'), ['/activation/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend','ActivationCatlog'), '#', ['class' => 'btn btn-success']) ?>
    </p>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createActivationCatlog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cat_name',
            'product_id',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
