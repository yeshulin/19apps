<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\FormPhoto */

$this->title = Yii::t('backend','createPhoto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend','Photo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'college'=>$college
    ]) ?>

</div>
