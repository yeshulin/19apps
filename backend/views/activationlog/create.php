<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Activationlog */

$this->title = 'Create Activationlog';
$this->params['breadcrumbs'][] = ['label' => 'Activationlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activationlog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
