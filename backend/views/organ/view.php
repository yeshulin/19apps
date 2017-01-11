<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organ */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Organ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organ-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend','deleteConfirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    $formatter=new \common\widgets\Formatter();
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'formatter'=>$formatter,
        'attributes' => [
            'id',
//            'url:url',
            'userid',
            'name',
            'email:email',
            'mobile',
            'phoneman',
//            'detail:ntext',

            'status:status',
            'organbook_img:Image',
//            'statementtype',
//            'info',
            'card_img:Image',
            'card_num',
            'updated_at:datetime',
            'created_at:datetime',
            'usertype:usertype',
        ],
    ]) ?>

</div>
