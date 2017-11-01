<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-summary-daily-hour-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'VAL1')->textInput() ?>

    <?= $form->field($model, 'VAL2')->textInput() ?>

    <?= $form->field($model, 'VAL3')->textInput() ?>

    <?= $form->field($model, 'VAL4')->textInput() ?>

    <?= $form->field($model, 'VAL5')->textInput() ?>

    <?= $form->field($model, 'VAL6')->textInput() ?>

    <?= $form->field($model, 'VAL7')->textInput() ?>

    <?= $form->field($model, 'VAL8')->textInput() ?>

    <?= $form->field($model, 'VAL9')->textInput() ?>

    <?= $form->field($model, 'VAL10')->textInput() ?>

    <?= $form->field($model, 'VAL11')->textInput() ?>

    <?= $form->field($model, 'VAL12')->textInput() ?>

    <?= $form->field($model, 'VAL13')->textInput() ?>

    <?= $form->field($model, 'VAL14')->textInput() ?>

    <?= $form->field($model, 'VAL15')->textInput() ?>

    <?= $form->field($model, 'VAL16')->textInput() ?>

    <?= $form->field($model, 'VAL17')->textInput() ?>

    <?= $form->field($model, 'VAL18')->textInput() ?>

    <?= $form->field($model, 'VAL19')->textInput() ?>

    <?= $form->field($model, 'VAL20')->textInput() ?>

    <?= $form->field($model, 'VAL21')->textInput() ?>

    <?= $form->field($model, 'VAL22')->textInput() ?>

    <?= $form->field($model, 'VAL23')->textInput() ?>

    <?= $form->field($model, 'VAL24')->textInput() ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
