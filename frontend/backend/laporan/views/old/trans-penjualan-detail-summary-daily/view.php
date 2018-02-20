<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetailSummaryDaily */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Detail Summary Dailies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-detail-summary-daily-view">

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
            'TGL',
            'PRODUCT_ID',
            'PRODUCT_NM',
            'PRODUCT_PROVIDER',
            'PRODUCT_PROVIDER_NO',
            'PRODUCT_PROVIDER_NM',
            'PRODUCT_QTY',
            'HPP',
            'HARGA_JUAL',
            'SUB_TOTAL',
            'CREATE_AT',
            'UPDATE_AT',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>
