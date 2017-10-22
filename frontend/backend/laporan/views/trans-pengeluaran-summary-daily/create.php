<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryDaily */

$this->title = 'Create Trans Pengeluaran Summary Daily';
$this->params['breadcrumbs'][] = ['label' => 'Trans Pengeluaran Summary Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pengeluaran-summary-daily-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
