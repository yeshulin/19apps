<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Photo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','createPhoto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        $formatter= new \common\widgets\Formatter();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter'=>$formatter,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'userid',
//            'username',
//            'datetime',
//            'ip',
            // 'photo:ntext',
             'name',
//             'info:ntext',
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
            // 'looks',
            // 'indeximg',
            // 'gkleibie',
            // 'address',
            // 'arrdata',
//             'status:status',
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

            ['class' => '\common\widgets\ActionColumn'],
        ],
    ]); ?>
</div>
