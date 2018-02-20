<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetailSummaryDaily */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-detail-summary-daily-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'PRODUCT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_PROVIDER_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_QTY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HPP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_JUAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SUB_TOTAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
