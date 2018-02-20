<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\laporan\models\JurnalTransaksiBulanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jurnal Transaksi Bulans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurnal-transaksi-bulan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jurnal Transaksi Bulan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'JURNAL_BULAN',
            'ACCESS_GROUP',
            'STORE_ID',
            'TRANS_DATE',
            'TAHUN',
            //'BULAN',
            //'JUMLAH',
            //'STT_PAY',
            //'STT_NM',
            //'AKUN_CODE',
            //'AKUN_NM',
            //'KTG_CODE',
            //'KTG_NM',
            //'CREATE_AT',
            //'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
