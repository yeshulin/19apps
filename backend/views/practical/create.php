<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Practical */

$this->title = '创建实训';
$this->params['breadcrumbs'][] = ['label' => '实训列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practical-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
