<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormPhoto */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Photo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend','update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend','delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' =>Yii::t('backend','deleteConfirm'),
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
//            'userid',
//            'username',
            'name',
            'info:ntext',
            'indeximg:Image',
            'status:status',
//            'photo',
            [
                'attribute' => 'photo',
                'label'=>'相册',
                'format'=>'photo',
                'value'=>$model->photo,
//                    return $model->photo;
//                },
//                'filter'=>$college,
                'Options' => ['width' => '150'],
            ],
            'college:college',
            'created_at:datetime',
            'updated_at:datetime'
        ],
    ]) ?>

</div>
