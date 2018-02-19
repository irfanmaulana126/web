<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\inventory\models\ProductStockClosingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Stock Closings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-stock-closing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Stock Closing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UNIX_BULAN_ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'PRODUCT_ID',
            'TAHUN',
            //'BULAN',
            //'STOCK_AWAL',
            //'STOCK_BARU',
            //'STOCK_TERJUAL',
            //'STOCK_REFUND',
            //'STOCK_AKHIR',
            //'STOCK_BALANCE_CLOSING',
            //'STOCK_INPUT_ACTUAL',
            //'STOCK_AKHIR_ACTUAL',
            //'STOCK_AWAL_ACTUAL',
            //'CREATE_BY',
            //'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',
            //'CREATE_UUID',
            //'UPDATE_UUID',
            //'STATUS',
            //'DCRP_DETIL:ntext',
            //'YEAR_AT',
            //'MONTH_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
