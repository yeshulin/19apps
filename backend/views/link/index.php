<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '友情链接';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建链接', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('分类管理', ['/link/link-cate/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('更新缓存', ['cache'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'linkid',
//            'name',
            [
                'attribute' => 'name',
                'format' => 'HTML',
                'value' => function ($model) {
                    return Html::a($model->name, $model->url);
                },
            ],
//            'url:url',
            [
                'attribute' => 'logo',
                'format' => 'HTML',
                'value' => function ($model) {
                    return $model->linktype==$model::TYPE_LOGO ? Html::img($model->logo,["width"=>"150px"]) : '';
                },
            ],
//            'logo',
            // 'introduce:ntext',
//            'linktype',
            [
                'attribute' => 'linkcatid',
                'value' => function ($model) {
                    return $model::dropDown('linkcatid', $model->linkcatid);
                },
                "filter" => $searchModel::dropDown('linkcatid'),
            ],
            [
                'attribute' => 'linktype',
                'value' => function ($model) {
                    return $model::dropDown('linktype', $model->linktype);
                },
                "filter" => $searchModel::dropDown('linktype'),
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model::dropDown('status', $model->status);
                },
                "filter" => $searchModel::dropDown('status'),
            ],
             'order',
//             'status',
             'create_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
