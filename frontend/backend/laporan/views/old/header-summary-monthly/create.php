<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly */

$this->title = 'Create Trans Penjualan Header Summary Monthly';
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-monthly-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
