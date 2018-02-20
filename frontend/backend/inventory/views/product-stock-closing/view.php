<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\inventory\models\ProductStockClosing */

$this->title = $model->UNIX_BULAN_ID;
$this->params['breadcrumbs'][] = ['label' => 'Product Stock Closings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-closing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'UNIX_BULAN_ID' => $model->UNIX_BULAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'UNIX_BULAN_ID' => $model->UNIX_BULAN_ID, 'YEAR_AT' => $model->YEAR_AT, 'MONTH_AT' => $model->MONTH_AT], [
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
            'UNIX_BULAN_ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'PRODUCT_ID',
            'TAHUN',
            'BULAN',
            'STOCK_AWAL',
            'STOCK_BARU',
            'STOCK_TERJUAL',
            'STOCK_REFUND',
            'STOCK_AKHIR',
            'STOCK_BALANCE_CLOSING',
            'STOCK_INPUT_ACTUAL',
            'STOCK_AKHIR_ACTUAL',
            'STOCK_AWAL_ACTUAL',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            'CREATE_UUID',
            'UPDATE_UUID',
            'STATUS',
            'DCRP_DETIL:ntext',
            'YEAR_AT',
            'MONTH_AT',
        ],
    ]) ?>

</div>
