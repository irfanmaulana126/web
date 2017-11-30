<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingShift */

$this->title = 'Update Hrd Setting Shift: ' . $model->SHIFT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Shifts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SHIFT_ID, 'url' => ['view', 'id' => $model->SHIFT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-setting-shift-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
