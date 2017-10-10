<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'ACCESS_ID') ?>

    <?= $form->field($model, 'GOLONGAN') ?>

    <?php // echo $form->field($model, 'TRANS_ID') ?>

    <?php // echo $form->field($model, 'OFLINE_ID') ?>

    <?php // echo $form->field($model, 'TRANS_DATE') ?>

    <?php // echo $form->field($model, 'PRODUCT_ID') ?>

    <?php // echo $form->field($model, 'PRODUCT_NM') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER_NO') ?>

    <?php // echo $form->field($model, 'PRODUCT_PROVIDER_NM') ?>

    <?php // echo $form->field($model, 'PRODUCT_QTY') ?>

    <?php // echo $form->field($model, 'UNIT_ID') ?>

    <?php // echo $form->field($model, 'UNIT_NM') ?>

    <?php // echo $form->field($model, 'HARGA_JUAL') ?>

    <?php // echo $form->field($model, 'DISCOUNT') ?>

    <?php // echo $form->field($model, 'PROMO') ?>

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
