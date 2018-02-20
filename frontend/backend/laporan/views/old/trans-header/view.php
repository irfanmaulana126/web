<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeader */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'TRANS_ID' => $model->TRANS_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID, 'STORE_ID' => $model->STORE_ID, 'TRANS_ID' => $model->TRANS_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], [
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
            'ACCESS_ID',
            'TRANS_ID',
            'OFLINE_ID',
            'TRANS_DATE',
            'OPENCLOSE_ID',
            'TOTAL_PRODUCT',
            'SUB_TOTAL_HARGA',
            'PPN',
            'TOTAL_HARGA',
            'MERCHANT_ID',
            'TYPE_PAY_ID',
            'TYPE_PAY_NM',
            'BANK_ID',
            'BANK_NM',
            'MERCHANT_NM',
            'MERCHANT_NO',
            'CONSUMER_ID',
            'CONSUMER_NM',
            'CONSUMER_EMAIL:email',
            'CONSUMER_PHONE',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'STATUS',
            'DCRP_DETIL:ntext',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>
