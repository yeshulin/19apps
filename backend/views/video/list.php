<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频列表';
?>
<div class="video-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'videoid',
//            'vmsid',
            'videoname',
            'time',
//            'thumb',
             'create_at:datetime',
            // 'update_at',
            // 'userid',
            // 'usertype',
//             'type',
//             'status',
            // 'order',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php $this->registerJs('
    $("#w0").find("tbody").find("tr").mousemove(function(){
            $(this).css("background-color", "#CCC");
        }).mouseout(function(){
            $(this).css("background-color", "")
        }).on("click",function(){
            parent.$("#courseknows-linkid").val($(this).attr("data-key"));
            var index = parent.layer.getFrameIndex(window.name);
            parent.layer.close(index);
        })
    ', \yii\web\View::POS_END)?>
</div>
