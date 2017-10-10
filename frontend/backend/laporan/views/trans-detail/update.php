<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetail */

$this->title = 'Update Trans Penjualan Detail: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'TRANS_ID' => $model->TRANS_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-penjualan-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
