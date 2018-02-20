<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\JurnalTransaksiBulan */

$this->title = 'Update Jurnal Transaksi Bulan: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Jurnal Transaksi Bulans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->JURNAL_BULAN, 'url' => ['view', 'id' => $model->JURNAL_BULAN]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jurnal-transaksi-bulan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
