<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\payment\models\StoreMembershipPaket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-membership-paket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PAKET_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_DURATION')->textInput() ?>

    <?= $form->field($model, 'PAKET_DURATION_BONUS')->textInput() ?>

    <?= $form->field($model, 'HARGA_BULAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_HARI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_PAKET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HARGA_PAKET_HARI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAKET_STT')->textInput() ?>

    <?= $form->field($model, 'PAKET_STT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
