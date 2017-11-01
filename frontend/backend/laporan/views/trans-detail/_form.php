<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GOLONGAN')->textInput() ?>

    <?= $form->field($model, 'TRANS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OFLINE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_DATE')->textInput() ?>

    <?= $form->field($model, 'PRODUCT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_QTY')->textInput() ?>

    <?= $form->field($model, 'UNIT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UNIT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_JUAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DISCOUNT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PROMO')->textInput(['maxlength' => true]) ?>

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
