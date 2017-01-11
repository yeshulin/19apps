<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FormFeedback */

$this->title = Yii::t('backend','createFeedback');
$this->params['breadcrumbs'][] = ['label' =>Yii::t('backend','Feedback'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
