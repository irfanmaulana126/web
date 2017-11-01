<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryMonthly */

$this->title = 'Update Trans Pengeluaran Summary Monthly: ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Pengeluaran Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trans-pengeluaran-summary-monthly-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
