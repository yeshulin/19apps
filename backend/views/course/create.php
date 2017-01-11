<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Course */

$this->title = '创建课程';
$this->params['breadcrumbs'][] = ['label' => '课程列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
