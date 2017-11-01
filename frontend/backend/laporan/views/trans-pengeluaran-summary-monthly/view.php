<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryMonthly */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Pengeluaran Summary Monthlies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-pengeluaran-summary-monthly-view">

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
            'TAHUN',
            'BULAN',
            'TTL_1',
            'TTL_2',
            'TTL_3',
            'TTL_4',
            'TTL_5',
            'TTL_6',
            'TTL_7',
            'TTL_8',
            'TTL_9',
            'CNT_1',
            'CNT_2',
            'CNT_3',
            'CNT_4',
            'CNT_5',
            'CNT_6',
            'CNT_7',
            'CNT_8',
            'CNT_9',
            'KETERANGAN:ntext',
            'STATUS',
            'CREATE_AT',
            'UPDATE_AT',
        ],
    ]) ?>

</div>
