<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\HrdAbsenRekapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hrd Absen Rekaps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hrd-absen-rekap-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hrd Absen Rekap', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_GROUP',
            'STORE_ID',
            'KARYAWAN_ID',
            'KARYAWAN',
            // 'TGL',
            // 'WAKTU_MASUK',
            // 'WAKTU_KELUAR',
            // 'SHIFT_ID',
             'SHIFT_NM',
            // 'SHIFT_IN',
            // 'SHIFT_OUT',
            // 'SHIFT_TELAT',
            // 'SHIFT_PULANG',
            // 'SHIFT_RADIUS',
            // 'SELISIH_TELAT',
            // 'SELISIH_AWALPULANG',
            // 'KELEBIHAN_WAKTU',
            // 'IZIN_STT',
            // 'IZIN_STT_NM',
            // 'IZIN',
            // 'IZIN_NM',
            // 'MASUK_LAT',
            // 'MASUK_LAG',
            // 'MASUK_RADIUS',
            // 'PULANG_LAT',
            // 'PULANG_LAG',
            // 'PULANG_RADIUS',
            // 'ACTIVE_TELAT',
            // 'ACTIVE_PULANG',
            // 'ACTIVE_IZIN',
            // 'POT_PERSEN_TELAT',
            // 'POT_RUPIAH_TELAT',
            // 'POT_JAM_TELAT',
            // 'POT_PERSEN_PULANG',
            // 'POT_RUPIAH_PULANG',
            // 'POT_JAM_PULANG',
            // 'LEMBUR_PERSEN',
            // 'LEMBUR_RUPIAH',
            // 'LEMBUR_JAM',
            // 'UPAH_HARIAN',
            // 'ID_TELAT',
            // 'ID_AWALPULANG',
            // 'IN_ABSENID',
            // 'OUT_ABSENID',
            // 'IN_SEQ',
            // 'SEQ_SHIFT',
            // 'ID_LEMBUR',
            // 'CREATE_BY',
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
