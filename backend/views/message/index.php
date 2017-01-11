<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend',"Message");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t("backend","createMessage"), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'send_from_id',
            'send_to_id',
//            'folder',
            [
                "attribute"=>"folder",
                "value"=>function($model){
                    return \backend\models\Message::getFolder(false,$model->folder);
                },
                "filter"=>\backend\models\Message::getFolder(true)
            ],
//            'status',
            [
                "attribute"=>"status",
                "value"=>function($model){
                    return \backend\models\Message::getStatus(false,$model->status);
                },
                "filter"=>\backend\models\Message::getStatus(true)
            ],
            // 'message_time',
            // 'subject',
            // 'content:ntext',
            // 'replyid',
            // 'del_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
