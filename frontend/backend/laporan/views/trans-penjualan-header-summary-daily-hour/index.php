<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Penjualan Header Summary Daily Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-daily-hour-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Penjualan Header Summary Daily Hour', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'VAL1',
            // 'VAL2',
            // 'VAL3',
            // 'VAL4',
            // 'VAL5',
            // 'VAL6',
            // 'VAL7',
            // 'VAL8',
            // 'VAL9',
            // 'VAL10',
            // 'VAL11',
            // 'VAL12',
            // 'VAL13',
            // 'VAL14',
            // 'VAL15',
            // 'VAL16',
            // 'VAL17',
            // 'VAL18',
            // 'VAL19',
            // 'VAL20',
            // 'VAL21',
            // 'VAL22',
            // 'VAL23',
            // 'VAL24',
            // 'CREATE_AT',
            // 'UPDATE_AT',
            // 'KETERANGAN:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
