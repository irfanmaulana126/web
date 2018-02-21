<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetTransaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TRANS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANSCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANSCODE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TRANS_TYPE')->textInput() ?>

    <?= $form->field($model, 'TRANS_TYPE_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JUMLAH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CURRENT_TGL')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'WAKTU')->textInput() ?>

    <?= $form->field($model, 'REF_NUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
