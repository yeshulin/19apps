<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Link */

$this->title = '创建友情链接';
$this->params['breadcrumbs'][] = ['label' => '友情链接', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
