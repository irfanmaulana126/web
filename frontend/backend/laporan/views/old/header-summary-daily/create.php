<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDaily */

$this->title = 'Create Trans Penjualan Header Summary Daily';
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-daily-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
