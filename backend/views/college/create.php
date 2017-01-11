<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FormCollege */

$this->title = Yii::t('backend','createCollege');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','College'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-college-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
