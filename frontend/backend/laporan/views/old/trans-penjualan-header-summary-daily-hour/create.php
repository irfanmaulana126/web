<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHour */

$this->title = 'Create Trans Penjualan Header Summary Daily Hour';
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Daily Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-daily-hour-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
