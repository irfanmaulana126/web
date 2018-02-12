<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\StoreKasir */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-kasir-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'KASIR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KASIR_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PERANGKAT_UUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KASIR_STT')->textInput() ?>

    <?= $form->field($model, 'KASIR_STT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DOMPET_AUTODEBET')->textInput() ?>

    <?= $form->field($model, 'DOMPET_AUTODEBET_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAYMENT_METHODE')->textInput() ?>

    <?= $form->field($model, 'PAYMENT_METHODE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_ID')->textInput() ?>

    <?= $form->field($model, 'DATE_START')->textInput() ?>

    <?= $form->field($model, 'DATE_END')->textInput() ?>

    <?= $form->field($model, 'KONTRAK_DURASI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KONTRAK_DATE')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
