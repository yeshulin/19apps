<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = '更新角色: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
