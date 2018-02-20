<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\inventory\models\ProductStockClosing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-stock-closing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UNIX_BULAN_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAHUN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BULAN')->textInput() ?>

    <?= $form->field($model, 'STOCK_AWAL')->textInput() ?>

    <?= $form->field($model, 'STOCK_BARU')->textInput() ?>

    <?= $form->field($model, 'STOCK_TERJUAL')->textInput() ?>

    <?= $form->field($model, 'STOCK_REFUND')->textInput() ?>

    <?= $form->field($model, 'STOCK_AKHIR')->textInput() ?>

    <?= $form->field($model, 'STOCK_BALANCE_CLOSING')->textInput() ?>

    <?= $form->field($model, 'STOCK_INPUT_ACTUAL')->textInput() ?>

    <?= $form->field($model, 'STOCK_AKHIR_ACTUAL')->textInput() ?>

    <?= $form->field($model, 'STOCK_AWAL_ACTUAL')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'CREATE_UUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_UUID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
