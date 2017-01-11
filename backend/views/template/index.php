<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend',"Template");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend',"createTemplate"), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                "attribute"=>"id",
                "headerOptions"=>["width"=>"80px"]
            ],
//            'name',
            [
                "attribute"=>"name",
                "filter"=>\backend\models\Template::getApplication(),
                "value"=>function($model){
                    return \backend\models\Template::getApplication(false,$model->name);
                },
                "headerOptions"=>["width"=>"150px"]
            ],
//            'type',
            [
                "attribute"=>"type",
                "filter"=>\backend\models\Template::getType(),
                "value"=>function($model){
                    return \backend\models\Template::getType(false,$model->type);
                },
                "headerOptions"=>["width"=>"90px"]
            ],
//            'content',
//            [
//                "attribute"=>"content",
//                "format"=>"html",
//                "headerOptions"=>["width"=>"500px"]
//            ],
            'created_at:datetime',
//            'isworking',
            [
                "attribute"=>"isworking",
                "filter"=>\backend\models\Template::getIsWorking(true),
                "value"=>function($model){
                    return \backend\models\Template::getIsWorking(false,$model->isworking);
                }
            ],
            // 'updated_at',
            // 'userid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
