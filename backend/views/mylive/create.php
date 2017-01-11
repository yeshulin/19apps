<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mylive */

$this->title = Yii::t('backend','create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mylive'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
