<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OFLINE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_DATE')->textInput() ?>

    <?= $form->field($model, 'OPENCLOSE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_PRODUCT')->textInput() ?>

    <?= $form->field($model, 'SUB_TOTAL_HARGA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PPN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_HARGA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MERCHANT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE_PAY_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPE_PAY_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BANK_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BANK_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MERCHANT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MERCHANT_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONSUMER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONSUMER_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONSUMER_EMAIL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CONSUMER_PHONE')->textInput(['maxlength' => true]) ?>

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
