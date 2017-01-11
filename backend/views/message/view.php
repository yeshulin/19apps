<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t("backend","Message"), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

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
            'send_from_id',
            'send_to_id',
//            'folder',
//            [
//                "attribute"=>"folder",
//                "value"=>\backend\models\Message::getFolder(false,$model->folder)
//            ],
//            'status',
            [
                "attribute"=>"status",
                "value"=>\backend\models\Message::getStatus(false,$model->status)
            ],
            'created_at:datetime',
            'subject',
            'content:ntext',
            'replyid',
//            'del_type',
        ],
    ]) ?>

</div>
