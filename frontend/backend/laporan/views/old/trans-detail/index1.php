<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Penjualan Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'ACCESS_ID',
            'GOLONGAN',
            // 'TRANS_ID',
            // 'OFLINE_ID',
            // 'TRANS_DATE',
            // 'PRODUCT_ID',
            // 'PRODUCT_NM',
            // 'PRODUCT_PROVIDER',
            // 'PRODUCT_PROVIDER_NO',
            // 'PRODUCT_PROVIDER_NM',
            // 'PRODUCT_QTY',
            // 'UNIT_ID',
            // 'UNIT_NM',
            // 'HARGA_JUAL',
            // 'DISCOUNT',
            // 'PROMO',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',
            // 'STATUS',
            // 'DCRP_DETIL:ntext',
            // 'YEAR_AT',
            // 'MONTH_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
