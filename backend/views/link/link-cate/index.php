<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LinkCateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['/link/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-cate-index">

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

            'linkcatid',
            'name',
            'create_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
