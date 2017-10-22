<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\TransPengeluaranSummaryMonthlySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trans Pengeluaran Summary Monthlies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pengeluaran-summary-monthly-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trans Pengeluaran Summary Monthly', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'TTL_1',
            // 'TTL_2',
            // 'TTL_3',
            // 'TTL_4',
            // 'TTL_5',
            // 'TTL_6',
            // 'TTL_7',
            // 'TTL_8',
            // 'TTL_9',
            // 'CNT_1',
            // 'CNT_2',
            // 'CNT_3',
            // 'CNT_4',
            // 'CNT_5',
            // 'CNT_6',
            // 'CNT_7',
            // 'CNT_8',
            // 'CNT_9',
            // 'KETERANGAN:ntext',
            // 'STATUS',
            // 'CREATE_AT',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
