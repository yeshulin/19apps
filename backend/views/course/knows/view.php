<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CourseKnows */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['/course/course-sections/index', 'courseid'=>$model->courseid]];
$this->params['breadcrumbs'][] = ['label' => '小节列表', 'url' => ['/course/course-bars/index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid]];
$this->params['breadcrumbs'][] = ['label' => '知识点列表', 'url' => ['/course/course-knows/index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$model->barsid]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-knows-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->knowsid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->knowsid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'knowsid',
            'name',
            'barsid',
            'type',
            'linkid',
            'order',
        ],
    ]) ?>

</div>
