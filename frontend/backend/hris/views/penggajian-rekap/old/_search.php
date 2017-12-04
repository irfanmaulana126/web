<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenRekapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-absen-rekap-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'KARYAWAN_ID') ?>

    <?= $form->field($model, 'KARYAWAN') ?>

    <?php // echo $form->field($model, 'TGL') ?>

    <?php // echo $form->field($model, 'WAKTU_MASUK') ?>

    <?php // echo $form->field($model, 'WAKTU_KELUAR') ?>

    <?php // echo $form->field($model, 'SHIFT_ID') ?>

    <?php // echo $form->field($model, 'SHIFT_NM') ?>

    <?php // echo $form->field($model, 'SHIFT_IN') ?>

    <?php // echo $form->field($model, 'SHIFT_OUT') ?>

    <?php // echo $form->field($model, 'SHIFT_TELAT') ?>

    <?php // echo $form->field($model, 'SHIFT_PULANG') ?>

    <?php // echo $form->field($model, 'SHIFT_RADIUS') ?>

    <?php // echo $form->field($model, 'SELISIH_TELAT') ?>

    <?php // echo $form->field($model, 'SELISIH_AWALPULANG') ?>

    <?php // echo $form->field($model, 'KELEBIHAN_WAKTU') ?>

    <?php // echo $form->field($model, 'IZIN_STT') ?>

    <?php // echo $form->field($model, 'IZIN_STT_NM') ?>

    <?php // echo $form->field($model, 'IZIN') ?>

    <?php // echo $form->field($model, 'IZIN_NM') ?>

    <?php // echo $form->field($model, 'MASUK_LAT') ?>

    <?php // echo $form->field($model, 'MASUK_LAG') ?>

    <?php // echo $form->field($model, 'MASUK_RADIUS') ?>

    <?php // echo $form->field($model, 'PULANG_LAT') ?>

    <?php // echo $form->field($model, 'PULANG_LAG') ?>

    <?php // echo $form->field($model, 'PULANG_RADIUS') ?>

    <?php // echo $form->field($model, 'ACTIVE_TELAT') ?>

    <?php // echo $form->field($model, 'ACTIVE_PULANG') ?>

    <?php // echo $form->field($model, 'ACTIVE_IZIN') ?>

    <?php // echo $form->field($model, 'POT_PERSEN_TELAT') ?>

    <?php // echo $form->field($model, 'POT_RUPIAH_TELAT') ?>

    <?php // echo $form->field($model, 'POT_JAM_TELAT') ?>

    <?php // echo $form->field($model, 'POT_PERSEN_PULANG') ?>

    <?php // echo $form->field($model, 'POT_RUPIAH_PULANG') ?>

    <?php // echo $form->field($model, 'POT_JAM_PULANG') ?>

    <?php // echo $form->field($model, 'LEMBUR_PERSEN') ?>

    <?php // echo $form->field($model, 'LEMBUR_RUPIAH') ?>

    <?php // echo $form->field($model, 'LEMBUR_JAM') ?>

    <?php // echo $form->field($model, 'UPAH_HARIAN') ?>

    <?php // echo $form->field($model, 'ID_TELAT') ?>

    <?php // echo $form->field($model, 'ID_AWALPULANG') ?>

    <?php // echo $form->field($model, 'IN_ABSENID') ?>

    <?php // echo $form->field($model, 'OUT_ABSENID') ?>

    <?php // echo $form->field($model, 'IN_SEQ') ?>

    <?php // echo $form->field($model, 'SEQ_SHIFT') ?>

    <?php // echo $form->field($model, 'ID_LEMBUR') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'DCRP_DETIL') ?>

    <?php // echo $form->field($model, 'YEAR_AT') ?>

    <?php // echo $form->field($model, 'MONTH_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
