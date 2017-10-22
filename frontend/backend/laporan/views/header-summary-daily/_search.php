<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-summary-daily-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'TAHUN') ?>

    <?= $form->field($model, 'BULAN') ?>

    <?php // echo $form->field($model, 'TGL') ?>

    <?php // echo $form->field($model, 'TOTAL_HPP') ?>

    <?php // echo $form->field($model, 'TOTAL_SALES') ?>

    <?php // echo $form->field($model, 'TOTAL_PRODUCT') ?>

    <?php // echo $form->field($model, 'JUMLAH_TRANSAKSI') ?>

    <?php // echo $form->field($model, 'CNT_TUNAI') ?>

    <?php // echo $form->field($model, 'CNT_DEBET') ?>

    <?php // echo $form->field($model, 'CNT_KREDIT') ?>

    <?php // echo $form->field($model, 'CNT_EMONEY') ?>

    <?php // echo $form->field($model, 'TTL_TUNAI') ?>

    <?php // echo $form->field($model, 'TTL_DEBET') ?>

    <?php // echo $form->field($model, 'TTL_KREDIT') ?>

    <?php // echo $form->field($model, 'TTL_EMONEY') ?>

    <?php // echo $form->field($model, 'CNT_BCA') ?>

    <?php // echo $form->field($model, 'CNT_MANDIRI') ?>

    <?php // echo $form->field($model, 'CNT_BNI') ?>

    <?php // echo $form->field($model, 'CNT_BRI') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
