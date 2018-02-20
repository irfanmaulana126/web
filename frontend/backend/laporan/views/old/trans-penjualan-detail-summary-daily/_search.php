<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetailSummaryDailySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-detail-summary-daily-search">

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

    <?php // echo $form->field($model, 'PRODUCT_ID') ?>

    <?php // echo $form->field($model, 'PRODUCT_NM') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER_NO') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER_NM') ?>

    <?php // echo $form->field($model, 'PRODUCT_QTY') ?>

    <?php // echo $form->field($model, 'HPP') ?>

    <?php // echo $form->field($model, 'HARGA_JUAL') ?>

    <?php // echo $form->field($model, 'SUB_TOTAL') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
