<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单列表';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/statics/css/plugins/jqgrid/ui.jqgrid.css',['depends'=>['backend\assets\MainAsset'],$this::POS_END]);
?>
<div class="menu-index">

<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建菜单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => \yii\grid\CheckboxColumn::className()],
            'id',
            'name',
            'parent',
            'route',
            'order',
            // 'data',

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
