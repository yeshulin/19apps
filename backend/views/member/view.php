<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' =>  Yii::t("backend","Member"), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a( Yii::t("backend","update"), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a( Yii::t("backend","delete"), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t("backend","deleteConfirm"),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
			'headimg:Image',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'mobile',
//            'status',
			'linkage',
			'address',
			'postcode',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
