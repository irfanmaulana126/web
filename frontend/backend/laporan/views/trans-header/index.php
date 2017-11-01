<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Headers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Penjualan Header', ['create'], ['class' => 'btn btn-success']) ?>
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
            'TRANS_ID',
            // 'OFLINE_ID',
            // 'TRANS_DATE',
            // 'OPENCLOSE_ID',
            // 'TOTAL_PRODUCT',
            // 'SUB_TOTAL_HARGA',
            // 'PPN',
            // 'TOTAL_HARGA',
            // 'MERCHANT_ID',
            // 'TYPE_PAY_ID',
            // 'TYPE_PAY_NM',
            // 'BANK_ID',
            // 'BANK_NM',
            // 'MERCHANT_NM',
            // 'MERCHANT_NO',
            // 'CONSUMER_ID',
            // 'CONSUMER_NM',
            // 'CONSUMER_EMAIL:email',
            // 'CONSUMER_PHONE',
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
