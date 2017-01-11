<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CourseSectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '章节列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    html,body{
        height: inherit;
    }
</style>
<div class="course-sections-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建章节', ['create', 'courseid'=> $searchModel->courseid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sectionid',
            'name',
            'courseid',
            'order',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', '删除'),
                            'aria-label' => Yii::t('yii', '删除'),
                            'data-confirm'=>'该章节下包含小节，您确定要删除此项吗？',
                            'data-method'=>'post',
                            'data-pjax' => '0',
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
