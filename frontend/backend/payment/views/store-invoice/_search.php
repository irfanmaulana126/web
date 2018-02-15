<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreInvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-invoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'KASIR_ID') ?>

    <?= $form->field($model, 'STORE_STT') ?>

    <?php // echo $form->field($model, 'STORE_STT_NM') ?>

    <?php // echo $form->field($model, 'STORE_DATE_END_LATES') ?>

    <?php // echo $form->field($model, 'STORE_DATE_START') ?>

    <?php // echo $form->field($model, 'STORE_DATE_END') ?>

    <?php // echo $form->field($model, 'FAKTURE_NO') ?>

    <?php // echo $form->field($model, 'FAKTURE_DATE_START') ?>

    <?php // echo $form->field($model, 'FAKTURE_TEMPO') ?>

    <?php // echo $form->field($model, 'FAKTURE_DATE_END') ?>

    <?php // echo $form->field($model, 'PAYMENT_STT') ?>

    <?php // echo $form->field($model, 'PAYMENT_STT_NM') ?>

    <?php // echo $form->field($model, 'PAYMENT_DATE') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHODE') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHODE_NM') ?>

    <?php // echo $form->field($model, 'DOMPET_AUTODEBET') ?>

    <?php // echo $form->field($model, 'PAKET_ID') ?>

    <?php // echo $form->field($model, 'PAKET_GROUP') ?>

    <?php // echo $form->field($model, 'PAKET_NM') ?>

    <?php // echo $form->field($model, 'PAKET_DURATION') ?>

    <?php // echo $form->field($model, 'PAKET_DURATION_BONUS') ?>

    <?php // echo $form->field($model, 'HARGA_BULAN') ?>

    <?php // echo $form->field($model, 'HARGA_HARI') ?>

    <?php // echo $form->field($model, 'HARGA_PAKET') ?>

    <?php // echo $form->field($model, 'HARGA_PAKET_HARI') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
