<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingJamkerja */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-setting-jamkerja-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SHIFT_ID')->textInput() ?>

    <?= $form->field($model, 'SHIFT_NM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENTANG_BAWAH')->textInput() ?>

    <?= $form->field($model, 'RENTANG_ATAS')->textInput() ?>

    <?= $form->field($model, 'RENTANG_TENGAH')->textInput() ?>

    <?= $form->field($model, 'SHIFT_IN_BATAS_BAWAH')->textInput() ?>

    <?= $form->field($model, 'SHIFT_IN_BATAS_SEQ')->textInput() ?>

    <?= $form->field($model, 'SHIFT_IN_BATAS_ATAS')->textInput() ?>

    <?= $form->field($model, 'SHIFT_IN')->textInput() ?>

    <?= $form->field($model, 'SHIFT_OUT')->textInput() ?>

    <?= $form->field($model, 'SHIFT_SEQ')->textInput() ?>

    <?= $form->field($model, 'RADIUS_KOORDINAT')->textInput() ?>

    <?= $form->field($model, 'TOLERANSI_TELAT')->textInput() ?>

    <?= $form->field($model, 'TOLERANSI_PULANG')->textInput() ?>

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
