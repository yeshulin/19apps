<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建角色', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterRowOptions'=>['id'=>'name'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
//            'type',
            'description:ntext',
//            'rule_name',
//            'data:text',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {node} {update} {delete}',
                'buttons' => [
                    'node' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', $url, [
                            'title' => Yii::t('yii', '权限分配'),
                            'aria-label' => Yii::t('yii', '权限分配'),
                            'data-pjax' => '0',
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
