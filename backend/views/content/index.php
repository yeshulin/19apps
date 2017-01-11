<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Content');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createContent'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'catid',
            'title',
            'thumb',
            'keywords',
            // 'description:ntext',
            // 'url:url',
            // 'order',
            // 'status',
            // 'username',
            // 'inputtime',
            // 'updatetime',
            // 'videoPath',
//             'content',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
