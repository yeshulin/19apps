<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->linkid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('创建', ['delete', 'id' => $model->linkid], [
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
            'linkid',
//            'linktype',
            'name',
            'url:url',
//            'logo:Image',
            [
                'attribute' => 'logo',
                'format'=>"Html",
                'value' => $model->linktype == $model::TYPE_LOGO ? Html::img($model->logo,["width"=>"300px","height"=>"200px"]) : ''

            ],
            'introduce:ntext',
            'order',
//            'status',
            [
                'attribute' => 'linkcatid',
                'value' => \backend\models\Link::dropDown('linkcatid', $model->linkcatid)

            ],
            [
                'attribute' => 'linktype',
                'value' => \backend\models\Link::dropDown('linktype', $model->linktype)

            ],
            [
                'attribute' => 'status',
                'value' => \backend\models\Link::dropDown('status', $model->status)
            ],
            'create_at:datetime',
        ],
    ]) ?>

</div>
