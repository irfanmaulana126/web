<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHour */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Trans Penjualan Header Summary Daily Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trans-penjualan-header-summary-daily-hour-view">

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
            'TGL',
            'VAL1',
            'VAL2',
            'VAL3',
            'VAL4',
            'VAL5',
            'VAL6',
            'VAL7',
            'VAL8',
            'VAL9',
            'VAL10',
            'VAL11',
            'VAL12',
            'VAL13',
            'VAL14',
            'VAL15',
            'VAL16',
            'VAL17',
            'VAL18',
            'VAL19',
            'VAL20',
            'VAL21',
            'VAL22',
            'VAL23',
            'VAL24',
            'CREATE_AT',
            'UPDATE_AT',
            'KETERANGAN:ntext',
        ],
    ]) ?>

</div>
