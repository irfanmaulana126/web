<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\ppob\models\PpobTransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ppob Transaksis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ppob-transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ppob Transaksi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'TRANS_ID',
            'TRANS_DATE',
            'ACCESS_GROUP',
            'STORE_ID',
            // 'DETAIL_ID',
            // 'KODE',
            // 'NUMBER_ID',
            // 'KETERANGAN',
            // 'NOMINAL',
            // 'HARGA_KG',
            // 'HARGA_JUAL',
            // 'QTY',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
