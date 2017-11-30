<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenRekap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-absen-rekap-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KARYAWAN_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KARYAWAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'WAKTU_MASUK')->textInput() ?>

    <?= $form->field($model, 'WAKTU_KELUAR')->textInput() ?>

    <?= $form->field($model, 'SHIFT_ID')->textInput() ?>

    <?= $form->field($model, 'SHIFT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHIFT_IN')->textInput() ?>

    <?= $form->field($model, 'SHIFT_OUT')->textInput() ?>

    <?= $form->field($model, 'SHIFT_TELAT')->textInput() ?>

    <?= $form->field($model, 'SHIFT_PULANG')->textInput() ?>

    <?= $form->field($model, 'SHIFT_RADIUS')->textInput() ?>

    <?= $form->field($model, 'SELISIH_TELAT')->textInput() ?>

    <?= $form->field($model, 'SELISIH_AWALPULANG')->textInput() ?>

    <?= $form->field($model, 'KELEBIHAN_WAKTU')->textInput() ?>

    <?= $form->field($model, 'IZIN_STT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IZIN_STT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IZIN')->textInput() ?>

    <?= $form->field($model, 'IZIN_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MASUK_LAT')->textInput() ?>

    <?= $form->field($model, 'MASUK_LAG')->textInput() ?>

    <?= $form->field($model, 'MASUK_RADIUS')->textInput() ?>

    <?= $form->field($model, 'PULANG_LAT')->textInput() ?>

    <?= $form->field($model, 'PULANG_LAG')->textInput() ?>

    <?= $form->field($model, 'PULANG_RADIUS')->textInput() ?>

    <?= $form->field($model, 'ACTIVE_TELAT')->textInput() ?>

    <?= $form->field($model, 'ACTIVE_PULANG')->textInput() ?>

    <?= $form->field($model, 'ACTIVE_IZIN')->textInput() ?>

    <?= $form->field($model, 'POT_PERSEN_TELAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POT_RUPIAH_TELAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POT_JAM_TELAT')->textInput() ?>

    <?= $form->field($model, 'POT_PERSEN_PULANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POT_RUPIAH_PULANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'POT_JAM_PULANG')->textInput() ?>

    <?= $form->field($model, 'LEMBUR_PERSEN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LEMBUR_RUPIAH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LEMBUR_JAM')->textInput() ?>

    <?= $form->field($model, 'UPAH_HARIAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_TELAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_AWALPULANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IN_ABSENID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OUT_ABSENID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IN_SEQ')->textInput() ?>

    <?= $form->field($model, 'SEQ_SHIFT')->textInput() ?>

    <?= $form->field($model, 'ID_LEMBUR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
