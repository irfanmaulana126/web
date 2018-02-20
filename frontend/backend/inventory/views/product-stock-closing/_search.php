<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\inventory\models\ProductStockClosingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-stock-closing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UNIX_BULAN_ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'PRODUCT_ID') ?>

    <?= $form->field($model, 'TAHUN') ?>

    <?php // echo $form->field($model, 'BULAN') ?>

    <?php // echo $form->field($model, 'STOCK_AWAL') ?>

    <?php // echo $form->field($model, 'STOCK_BARU') ?>

    <?php // echo $form->field($model, 'STOCK_TERJUAL') ?>

    <?php // echo $form->field($model, 'STOCK_REFUND') ?>

    <?php // echo $form->field($model, 'STOCK_AKHIR') ?>

    <?php // echo $form->field($model, 'STOCK_BALANCE_CLOSING') ?>

    <?php // echo $form->field($model, 'STOCK_INPUT_ACTUAL') ?>

    <?php // echo $form->field($model, 'STOCK_AKHIR_ACTUAL') ?>

    <?php // echo $form->field($model, 'STOCK_AWAL_ACTUAL') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'CREATE_UUID') ?>

    <?php // echo $form->field($model, 'UPDATE_UUID') ?>

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
