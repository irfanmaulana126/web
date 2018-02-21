<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\DompetSaldo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dompet-saldo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALDO_DOMPET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALDO_MENEGNDAP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SALDO_JUALAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CURRENT_TGL')->textInput() ?>

    <?= $form->field($model, 'TGL')->textInput() ?>

    <?= $form->field($model, 'WAKTU')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
