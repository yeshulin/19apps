<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mypractical */

$this->title =Yii::t('backend','create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mypractical'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mypractical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
