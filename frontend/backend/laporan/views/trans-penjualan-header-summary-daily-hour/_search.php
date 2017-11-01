<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPenjualanHeaderSummaryDailyHourSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-penjualan-header-summary-daily-hour-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'TAHUN') ?>

    <?= $form->field($model, 'BULAN') ?>

    <?php // echo $form->field($model, 'TGL') ?>

    <?php // echo $form->field($model, 'VAL1') ?>

    <?php // echo $form->field($model, 'VAL2') ?>

    <?php // echo $form->field($model, 'VAL3') ?>

    <?php // echo $form->field($model, 'VAL4') ?>

    <?php // echo $form->field($model, 'VAL5') ?>

    <?php // echo $form->field($model, 'VAL6') ?>

    <?php // echo $form->field($model, 'VAL7') ?>

    <?php // echo $form->field($model, 'VAL8') ?>

    <?php // echo $form->field($model, 'VAL9') ?>

    <?php // echo $form->field($model, 'VAL10') ?>

    <?php // echo $form->field($model, 'VAL11') ?>

    <?php // echo $form->field($model, 'VAL12') ?>

    <?php // echo $form->field($model, 'VAL13') ?>

    <?php // echo $form->field($model, 'VAL14') ?>

    <?php // echo $form->field($model, 'VAL15') ?>

    <?php // echo $form->field($model, 'VAL16') ?>

    <?php // echo $form->field($model, 'VAL17') ?>

    <?php // echo $form->field($model, 'VAL18') ?>

    <?php // echo $form->field($model, 'VAL19') ?>

    <?php // echo $form->field($model, 'VAL20') ?>

    <?php // echo $form->field($model, 'VAL21') ?>

    <?php // echo $form->field($model, 'VAL22') ?>

    <?php // echo $form->field($model, 'VAL23') ?>

    <?php // echo $form->field($model, 'VAL24') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
