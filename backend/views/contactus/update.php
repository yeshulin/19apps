<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Contactus */

$this->title = '联系我们: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '联系我们', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="contactus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
