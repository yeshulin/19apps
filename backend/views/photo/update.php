<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormPhoto */

$this->title = Yii::t('backend','updatePhoto').': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Photo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend','update');
?>
<div class="form-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'college'=>$college
    ]) ?>

</div>
