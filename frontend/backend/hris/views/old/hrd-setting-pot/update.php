<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingPot */

$this->title = 'Update Hrd Setting Pot: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Setting Pots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-setting-pot-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
