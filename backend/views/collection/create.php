<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollection */

$this->title = Yii::t('backend','createCollection');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Collection'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="form-collection-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'college'=>$college,
    ]) ?>

</div>
