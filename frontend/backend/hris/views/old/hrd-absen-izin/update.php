<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenIzin */

$this->title = 'Update Hrd Absen Izin: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Hrd Absen Izins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'KARYAWAN_ID' => $model->KARYAWAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hrd-absen-izin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
