<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetailSummaryDaily */

$this->title = 'Create Trans Penjualan Detail Summary Daily';
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Detail Summary Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-detail-summary-daily-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
