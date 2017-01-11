<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormFeedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-feedback-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' =>Yii::t('backend','deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $formatter= new \common\widgets\Formatter();?>
    <?= DetailView::widget([
        'model' => $model,
        'formatter'=>$formatter,
        'attributes' => [
            'id',
            'userid',
            'username',
            'created_at:datetime',
            'updated_at:datetime',
            'ip',
            'leibie',
            'goods_name',
            'yjleibie',
            'content:ntext',
            'status:status',
        ],
    ]) ?>

</div>
