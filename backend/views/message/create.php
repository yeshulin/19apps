<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = Yii::t("backend","createMessage");
$this->params['breadcrumbs'][] = ['label' => Yii::t("backend","Message"), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
