<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreInvoice */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Store Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-invoice-view">

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
            'KASIR_ID',
            'STORE_STT',
            'STORE_STT_NM',
            'STORE_DATE_END_LATES',
            'STORE_DATE_START',
            'STORE_DATE_END',
            'FAKTURE_NO',
            'FAKTURE_DATE_START',
            'FAKTURE_TEMPO',
            'FAKTURE_DATE_END',
            'PAYMENT_STT',
            'PAYMENT_STT_NM',
            'PAYMENT_DATE',
            'PAYMENT_METHODE',
            'PAYMENT_METHODE_NM',
            'DOMPET_AUTODEBET',
            'PAKET_ID',
            'PAKET_GROUP',
            'PAKET_NM',
            'PAKET_DURATION',
            'PAKET_DURATION_BONUS',
            'HARGA_BULAN',
            'HARGA_HARI',
            'HARGA_PAKET',
            'HARGA_PAKET_HARI',
            'CREATE_BY',
            'UPDATE_BY',
            'CREATE_AT',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
