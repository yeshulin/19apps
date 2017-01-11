<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FormAddress */

$this->title = 'Create Form Address';
$this->params['breadcrumbs'][] = ['label' => 'Form Addresses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
