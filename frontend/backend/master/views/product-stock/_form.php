<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductStock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACCESS_GROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STORE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRODUCT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LAST_STOCK')->textInput() ?>

    <?= $form->field($model, 'INPUT_DATE')->textInput() ?>

    <?= $form->field($model, 'INPUT_TIME')->textInput() ?>

    <?= $form->field($model, 'INPUT_STOCK')->textInput() ?>

    <?= $form->field($model, 'CURRENT_DATE')->textInput() ?>

    <?= $form->field($model, 'CURRENT_TIME')->textInput() ?>

    <?= $form->field($model, 'CURRENT_STOCK')->textInput() ?>

    <?= $form->field($model, 'SISA_STOCK')->textInput() ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'DCRP_DETIL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'YEAR_AT')->textInput() ?>

    <?= $form->field($model, 'MONTH_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
