<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mylab */

$this->title = Yii::t('backend','create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Mylab'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mylab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
