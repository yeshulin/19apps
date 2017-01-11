<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormFeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Feedback');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a(Yii::t('backend','createFeedback'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $formatter=new \common\widgets\Formatter();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter'=>$formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'username',
            'created_at:datetime',
            'updated_at:datetime',
//            'ip',
            // 'leibie',
            // 'goods_name',
            // 'yjleibie',
            // 'content:ntext',
//             'status:status',
            [
                "attribute"=>"status",
                "format"=>"status",
                "filter"=>$formatter->returnStatus()
            ],

            ['class' => '\common\widgets\ActionColumn'],
        ],
    ]); ?>
</div>
