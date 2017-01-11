<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Content */

$this->title = Yii::t('backend','createContent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','createContent'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
