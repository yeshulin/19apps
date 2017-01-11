<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Content */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Content'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'catid',
            'title',
            'thumb:Image',
            'keywords',
            'description:ntext',
            'url:url',
            'order',
//            'status',
            'username',
            'created_at:datetime',
            'updated_at:datetime',
            'videoPath',
            'content',
        ],
    ]) ?>
<?php $this->registerCss('
    img{
        width:150px;
        height:150px;
    }
')?>
</div>
