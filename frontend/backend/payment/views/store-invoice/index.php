<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\payment\models\StoreInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Store Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'KASIR_ID',
            'STORE_STT',
            //'STORE_STT_NM',
            //'STORE_DATE_END_LATES',
            //'STORE_DATE_START',
            //'STORE_DATE_END',
            //'FAKTURE_NO',
            //'FAKTURE_DATE_START',
            //'FAKTURE_TEMPO',
            //'FAKTURE_DATE_END',
            //'PAYMENT_STT',
            //'PAYMENT_STT_NM',
            //'PAYMENT_DATE',
            //'PAYMENT_METHODE',
            //'PAYMENT_METHODE_NM',
            //'DOMPET_AUTODEBET',
            //'PAKET_ID',
            //'PAKET_GROUP',
            //'PAKET_NM',
            //'PAKET_DURATION',
            //'PAKET_DURATION_BONUS',
            //'HARGA_BULAN',
            //'HARGA_HARI',
            //'HARGA_PAKET',
            //'HARGA_PAKET_HARI',
            //'CREATE_BY',
            //'UPDATE_BY',
            //'CREATE_AT',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
