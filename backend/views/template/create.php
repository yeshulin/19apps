<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Template */

$this->title = Yii::t('backend',"createTemplate");
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend',"Template"), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
