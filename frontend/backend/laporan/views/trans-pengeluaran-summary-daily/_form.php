<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryDaily */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-pengeluaran-summary-daily-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'ACCOUNT_ID')->textInput() ?>

    <?= $form->field($model, 'ACCOUNT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_RUPIAH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_QTY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
