<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'ACCESS_ID') ?>

    <?= $form->field($model, 'TRANS_ID') ?>

    <?php // echo $form->field($model, 'OFLINE_ID') ?>

    <?php // echo $form->field($model, 'TRANS_DATE') ?>

    <?php // echo $form->field($model, 'OPENCLOSE_ID') ?>

    <?php // echo $form->field($model, 'TOTAL_PRODUCT') ?>

    <?php // echo $form->field($model, 'SUB_TOTAL_HARGA') ?>

    <?php // echo $form->field($model, 'PPN') ?>

    <?php // echo $form->field($model, 'TOTAL_HARGA') ?>

    <?php // echo $form->field($model, 'MERCHANT_ID') ?>

    <?php // echo $form->field($model, 'TYPE_PAY_ID') ?>

    <?php // echo $form->field($model, 'TYPE_PAY_NM') ?>

    <?php // echo $form->field($model, 'BANK_ID') ?>

    <?php // echo $form->field($model, 'BANK_NM') ?>

    <?php // echo $form->field($model, 'MERCHANT_NM') ?>

    <?php // echo $form->field($model, 'MERCHANT_NO') ?>

    <?php // echo $form->field($model, 'CONSUMER_ID') ?>

    <?php // echo $form->field($model, 'CONSUMER_NM') ?>

    <?php // echo $form->field($model, 'CONSUMER_EMAIL') ?>

    <?php // echo $form->field($model, 'CONSUMER_PHONE') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'DCRP_DETIL') ?>

    <?php // echo $form->field($model, 'YEAR_AT') ?>

    <?php // echo $form->field($model, 'MONTH_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
