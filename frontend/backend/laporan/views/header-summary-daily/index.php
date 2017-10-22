<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Header Summary Dailies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-daily-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Penjualan Header Summary Daily', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'TAHUN',
            'BULAN',
            // 'TGL',
            // 'TOTAL_HPP',
            // 'TOTAL_SALES',
            // 'TOTAL_PRODUCT',
            // 'JUMLAH_TRANSAKSI',
            // 'CNT_TUNAI',
            // 'CNT_DEBET',
            // 'CNT_KREDIT',
            // 'CNT_EMONEY',
            // 'TTL_TUNAI',
            // 'TTL_DEBET',
            // 'TTL_KREDIT',
            // 'TTL_EMONEY',
            // 'CNT_BCA',
            // 'CNT_MANDIRI',
            // 'CNT_BNI',
            // 'CNT_BRI',
            // 'CREATE_AT',
            // 'UPDATE_AT',
            // 'KETERANGAN:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
