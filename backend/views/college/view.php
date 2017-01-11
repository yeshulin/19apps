<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollege */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','College'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-college-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend','deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'logo:Image',
            'xiaoxun',
            'info',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
