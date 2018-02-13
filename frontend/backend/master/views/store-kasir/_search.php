<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\StoreKasirSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-kasir-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'KASIR_ID') ?>

    <?= $form->field($model, 'KASIR_NM') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'PERANGKAT_UUID') ?>

    <?php // echo $form->field($model, 'KASIR_STT') ?>

    <?php // echo $form->field($model, 'KASIR_STT_NM') ?>

    <?php // echo $form->field($model, 'DOMPET_AUTODEBET') ?>

    <?php // echo $form->field($model, 'DOMPET_AUTODEBET_NM') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHODE') ?>

    <?php // echo $form->field($model, 'PAYMENT_METHODE_NM') ?>

    <?php // echo $form->field($model, 'PAKET_ID') ?>

    <?php // echo $form->field($model, 'DATE_START') ?>

    <?php // echo $form->field($model, 'DATE_END') ?>

    <?php // echo $form->field($model, 'KONTRAK_DURASI') ?>

    <?php // echo $form->field($model, 'KONTRAK_DATE') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
