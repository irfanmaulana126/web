<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsen */

$this->title = 'Update Hrd Absen: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Absens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-absen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
