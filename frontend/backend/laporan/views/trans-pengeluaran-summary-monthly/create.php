<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryMonthly */

$this->title = 'Create Trans Pengeluaran Summary Monthly';
$this->params['breadcrumbs'][] = ['label' => 'Trans Pengeluaran Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pengeluaran-summary-monthly-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
