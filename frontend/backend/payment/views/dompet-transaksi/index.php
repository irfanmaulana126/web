<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\payment\models\DompetTransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dompet Transaksis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dompet-transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dompet Transaksi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TRANS_ID',
            'STORE_ID',
            'ACCESS_GROUP',
            'VA_ID',
            'TRANSCODE',
            //'TRANSCODE_NM',
            //'TRANS_TYPE',
            //'TRANS_TYPE_NM',
            //'JUMLAH',
            //'CURRENT_TGL',
            //'TGL',
            //'WAKTU',
            //'REF_NUMBER',
            //'CREATE_BY',
            //'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
