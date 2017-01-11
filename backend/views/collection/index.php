<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\Search\FormCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Collection');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-collection-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createCollection'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $formatter=new \common\widgets\Formatter();?>
    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter'=>$formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'userid',
//            'username',
//            'ip',
            // 'rz_head_img',
            // 'zskvideo',
             'name',
            // 'info:ntext',
            // 'looks',
//             'college:college',
            [
                'attribute' => 'college',
                'label'=>'所属高校',
                'format'=>'college',
                'value'=>function($model){
                    return $model->college;
                },
                'filter'=>$formatter->returnCollege(),
               'headerOptions' => ['width' => '150'],
            ],
            // 'looknum',
            // 'rz_content_img',
            // 'goodcomment',
//             'status:status',
            'created_at:datetime',
            'updated_at:datetime',
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


            ['class' => '\common\widgets\ActionColumn',"header"=>"操作"],
        ],
    ]); ?>
</div>
