<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransStoran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-storan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPENCLOSE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TGL_STORAN')->textInput() ?>

    <?= $form->field($model, 'TOTALCASH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINAL_STORAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SISA_STORAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BANK_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BANK_NO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

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
