<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\master\models\ProductStockSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-stock-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'PRODUCT_ID') ?>

    <?= $form->field($model, 'LAST_STOCK') ?>

    <?php // echo $form->field($model, 'INPUT_DATE') ?>

    <?php // echo $form->field($model, 'INPUT_TIME') ?>

    <?php // echo $form->field($model, 'INPUT_STOCK') ?>

    <?php // echo $form->field($model, 'CURRENT_DATE') ?>

    <?php // echo $form->field($model, 'CURRENT_TIME') ?>

    <?php // echo $form->field($model, 'CURRENT_STOCK') ?>

    <?php // echo $form->field($model, 'SISA_STOCK') ?>

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
