<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Live */

$this->title = '创建直播';
$this->params['breadcrumbs'][] = ['label' => '直播列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
