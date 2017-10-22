<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDaily */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-summary-daily-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'TOTAL_HPP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_SALES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_PRODUCT')->textInput() ?>

    <?= $form->field($model, 'JUMLAH_TRANSAKSI')->textInput() ?>

    <?= $form->field($model, 'CNT_TUNAI')->textInput() ?>

    <?= $form->field($model, 'CNT_DEBET')->textInput() ?>

    <?= $form->field($model, 'CNT_KREDIT')->textInput() ?>

    <?= $form->field($model, 'CNT_EMONEY')->textInput() ?>

    <?= $form->field($model, 'TTL_TUNAI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_DEBET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_KREDIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_EMONEY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CNT_BCA')->textInput() ?>

    <?= $form->field($model, 'CNT_MANDIRI')->textInput() ?>

    <?= $form->field($model, 'CNT_BNI')->textInput() ?>

    <?= $form->field($model, 'CNT_BRI')->textInput() ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
