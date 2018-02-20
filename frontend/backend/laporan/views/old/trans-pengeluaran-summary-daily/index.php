<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPengeluaranSummaryDailySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Pengeluaran Summary Dailies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pengeluaran-summary-daily-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Pengeluaran Summary Daily', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'ACCOUNT_ID',
            // 'ACCOUNT_NM',
            // 'TOTAL_RUPIAH',
            // 'TOTAL_QTY',
            // 'KETERANGAN:ntext',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
