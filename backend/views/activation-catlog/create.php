<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ActivationCatlog */

$this->title =Yii::t('backend','createActivationCatlog');
$this->params['breadcrumbs'][] = ['label' => 'Activation Catlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activation-catlog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
