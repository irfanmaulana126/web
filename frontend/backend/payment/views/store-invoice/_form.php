<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreInvoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KASIR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_STT')->textInput() ?>

    <?= $form->field($model, 'STORE_STT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_DATE_END_LATES')->textInput() ?>

    <?= $form->field($model, 'STORE_DATE_START')->textInput() ?>

    <?= $form->field($model, 'STORE_DATE_END')->textInput() ?>

    <?= $form->field($model, 'FAKTURE_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FAKTURE_DATE_START')->textInput() ?>

    <?= $form->field($model, 'FAKTURE_TEMPO')->textInput() ?>

    <?= $form->field($model, 'FAKTURE_DATE_END')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_STT')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_STT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAYMENT_DATE')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_METHODE')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_METHODE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DOMPET_AUTODEBET')->textInput() ?>

    <?= $form->field($model, 'PAKET_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_DURATION')->textInput() ?>

    <?= $form->field($model, 'PAKET_DURATION_BONUS')->textInput() ?>

    <?= $form->field($model, 'HARGA_BULAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_HARI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_PAKET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_PAKET_HARI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
