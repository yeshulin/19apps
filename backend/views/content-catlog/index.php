<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContentCatlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','ContentCatlog');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-catlog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createContentCatlog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'catid',
            'catname',
            'pid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
