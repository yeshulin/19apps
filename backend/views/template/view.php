<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend',"Template"), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend',"update"), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend',"delete"), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend',"deleteConfirm"),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'type',
            [
                "attribute"=>"type",
                "value"=>\backend\models\Template::getType(false,$model->type)
            ],
//            'name',
            [
                "attribute"=>"name",
                "value"=>\backend\models\Template::getApplication(false,$model->name)
            ],
//            'content',
            [
                "attribute"=>"content",
                "format"=>"html",
//                "headerOptions"=>["width"=>"500px"]
            ],
            'created_at:datetime',
//            'isworking',
            [
                "attribute"=>"isworking",
                "value"=>\backend\models\Template::getIsWorking(false,$model->isworking)
            ],
            'updated_at:datetime',
            'userid',
        ],
    ]) ?>

</div>
