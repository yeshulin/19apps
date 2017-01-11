<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CourseBarsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '小节列表';
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['/course/course-sections/index', 'courseid'=>$searchModel->courseid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-bars-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建', ['create', 'courseid'=>$searchModel->courseid,  'sectionid'=>$searchModel->sectionid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'barsid',
            'name',
            'sectionid',
            'order',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', '删除'),
                            'aria-label' => Yii::t('yii', '删除'),
                            'data-confirm'=>'该小节下包含知识点，您确定要删除此项吗？',
                            'data-method'=>'post',
                            'data-pjax' => '0',
                        ] );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
