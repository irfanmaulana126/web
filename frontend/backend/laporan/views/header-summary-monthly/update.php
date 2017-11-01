<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly */

$this->title = 'Update Trans Penjualan Header Summary Monthly: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-penjualan-header-summary-monthly-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
