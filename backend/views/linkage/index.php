<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '联动列表';
if (!empty($breadcrumbs)) {
    $this->params['breadcrumbs'][] = ['label'=>$this->title,'url' => \yii\helpers\Url::to(['linkage/index'])];
    $this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $breadcrumbs);
}
else {
    $this->params['breadcrumbs'][] = $this->title;
}

//var_dump($this->params['breadcrumbs']);
?>
<div class="linkage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建联动数据', ['create','id'=>$id], ['class' => 'btn btn-success']) ?>
        <?php if ($id == 0): ?>
<!--        --><?//= Html::a('更新缓存', ['cache'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </p>
    <?php if ($id == 0): ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parentid',
            'order',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {create} {update} {delete} {cache}',
                'buttons' => [
                    'create' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                            'title' => '添加子菜单',
                            'aria-label' => '添加子菜单',
                            'data-pjax' => '0',
                        ] );
                    },
                     'cache' => function ($url, $model, $key) {
                        return Html::a('<span class="fa fa-spinner"></span>', $url, [
                            'title' => '更新缓存',
                            'aria-label' => '更新缓存',
                            'data-pjax' => '0',
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
    <?php else: ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'parentid',
                'order',
                'description',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {create} {update} {delete}',
                    'buttons' => [
                        'create' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                                'title' => '添加子菜单',
                                'aria-label' => '添加子菜单',
                                'data-pjax' => '0',
                            ] );
                        }
                    ],
                ],
            ],
        ]); ?>
    <?php endif; ?>
</div>
