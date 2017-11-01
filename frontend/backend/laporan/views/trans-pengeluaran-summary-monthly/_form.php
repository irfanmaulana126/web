<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryMonthly */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-pengeluaran-summary-monthly-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'TTL_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CNT_1')->textInput() ?>

    <?= $form->field($model, 'CNT_2')->textInput() ?>

    <?= $form->field($model, 'CNT_3')->textInput() ?>

    <?= $form->field($model, 'CNT_4')->textInput() ?>

    <?= $form->field($model, 'CNT_5')->textInput() ?>

    <?= $form->field($model, 'CNT_6')->textInput() ?>

    <?= $form->field($model, 'CNT_7')->textInput() ?>

    <?= $form->field($model, 'CNT_8')->textInput() ?>

    <?= $form->field($model, 'CNT_9')->textInput() ?>

    <?= $form->field($model, 'KETERANGAN')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
