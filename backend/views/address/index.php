<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormAddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend',"Address");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-address-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Form Address', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'address',
//            'status',
//            'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                "template"=>"{view}"
            ],
        ],
    ]); ?>
</div>
