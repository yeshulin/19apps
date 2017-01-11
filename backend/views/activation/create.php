<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Activation */

$this->title = Yii::t('backend', 'createActivation');
if (!isset($type) || $type == '') {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Activation'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="activation-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (isset($type) && $type != '') {
        echo $this->render('t_form', [
            'model' => $model,
            'type' => $type
        ]);
    } else {
        echo $this->render('_form', [
            'model' => $model,
        ]);
    }
    ?>

</div>
