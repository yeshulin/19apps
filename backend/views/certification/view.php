<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Certification */

$this->title = $model->certificationid;
$this->params['breadcrumbs'][] = ['label' => '专业认证', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->certificationid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->certificationid], [
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
            'certificationid',
            'certification_name',
            'examtype',
            'studyway',
            'object',
            'brief:ntext',
            'people:ntext',
            'order',
            'status',
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
