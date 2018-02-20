<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryMonthly */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-monthly-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'TAHUN',
            'BULAN',
            'TOTAL_HPP',
            'TOTAL_SALES',
            'TOTAL_PRODUCT',
            'JUMLAH_TRANSAKSI',
            'CNT_TUNAI',
            'CNT_DEBET',
            'CNT_KREDIT',
            'CNT_EMONEY',
            'TTL_TUNAI',
            'TTL_DEBET',
            'TTL_KREDIT',
            'TTL_EMONEY',
            'CNT_BCA',
            'CNT_MANDIRI',
            'CNT_BNI',
            'CNT_BRI',
            'CREATE_AT',
            'UPDATE_AT',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>
