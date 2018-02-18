<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTransaksi */

$this->title = 'Update Dompet Transaksi: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dompet Transaksis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TRANS_ID, 'url' => ['view', 'id' => $model->TRANS_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dompet-transaksi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
