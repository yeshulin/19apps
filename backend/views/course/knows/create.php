<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CourseKnows */

$this->title = '创建知识点';
$this->params['breadcrumbs'][] = ['label' => '章节列表', 'url' => ['/course/course-sections/index', 'courseid'=>$model->courseid]];
$this->params['breadcrumbs'][] = ['label' => '小节列表', 'url' => ['/course/course-bars/index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid]];
$this->params['breadcrumbs'][] = ['label' => '知识点列表', 'url' => ['/course/course-knows/index', 'courseid'=>$model->courseid, 'sectionid'=>$model->sectionid, 'barsid'=>$model->barsid]];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-knows-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
