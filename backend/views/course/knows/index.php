<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CourseKnowsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '知识点列表';
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['/course/course-sections/index', 'courseid'=>$searchModel->courseid]];
$this->params['breadcrumbs'][] = ['label' => '小节列表', 'url' => ['/course/course-bars/index', 'courseid'=>$searchModel->courseid, 'sectionid'=>$searchModel->sectionid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-knows-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建知识点', ['create', 'courseid'=>$searchModel->courseid, 'sectionid'=>$searchModel->sectionid, 'barsid'=>$searchModel->barsid], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'knowsid',
//            'name',
            [
                "attribute"=>"name",
                'format' => 'raw',
                'value'=> function ($model)
                {
                    return Html::a($model->name, null, ['onclick'=>'Play('.$model->linkid.')']);
                }
            ],
            'barsid',
            'type',
//            'linkid',
             'order',

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
</div>
