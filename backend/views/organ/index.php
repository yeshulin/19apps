<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Organ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organ-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createOrgan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $formatter=new \common\widgets\Formatter();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter'=>$formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'url:url',
            'userid',
            'name',
            'email:email',
            'card_num',
            // 'phone',
            // 'phoneman',
//             'detail:ntext',
            // 'addtime:datetime',
//             'status:status',
            // 'organbook_img',
            [
                'attribute' => 'status',
                'label'=>'审核状态',
                'format'=>'status',
                'value'=>function($model){
                    return $model->status;
                },
                'filter'=>$formatter->returnStatus(),
                'headerOptions' => ['width' => '150'],
            ],
            // 'statementtype',
            // 'info',
            // 'headimg',
            // 'category',
            // 'updatetime:datetime',
//             'usertype:usertype',
            [
                'attribute' => 'usertype',
                'format'=>'usertype',
                'value'=>function($model){
                    return $model->usertype;
                },
                'filter'=>$formatter->returnUsertype(),
                'headerOptions' => ['width' => '150'],
            ],

            [
                'class' => '\common\widgets\ActionColumn',
                "template"=>"{view}{delete}{pass}"
            ],
        ],
    ]); ?>
</div>
