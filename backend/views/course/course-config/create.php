<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CourseConfig */

$this->title = '创建配置';
$this->params['breadcrumbs'][] =['label' => '课程列表', 'url' => ['/course/index']];
$this->params['breadcrumbs'][] = ['label' => '课程配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-config-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
