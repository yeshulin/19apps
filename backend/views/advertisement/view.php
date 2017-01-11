<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Advertisement;

/* @var $this yii\web\View */
/* @var $model common\models\Advertisement */

$this->title = $model->display_name;
$this->params['breadcrumbs'][] = ['label' => '广告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertisement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'display_name',
            //'content:ntext',
            [
                'attribute' => 'status',
                'value'=>  Advertisement::dropDown('status', $model->status),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

    <h2>广告内容</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td><b>预览</b></td>
                <td><b>链接</b></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $content = unserialize($model->content);
                foreach ($content as $key => $value) {
            ?>
                <tr>
                    <td width="50%"><?php 
                    if($value['type'] == 1){
                        echo '<a href='.$value['url'].' target="_blank"><img class="img-responsive" src="'.Yii::$app->params['staticUrl'].$value['content'].'"></a>';
                    }elseif($value['type']==2){
                        echo '<a href='.$value['url'].' target="_blank">'.$value['content'].'</a>';
                    }
                    ?></td>
                    <td><?=$value['url']?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

</div>
