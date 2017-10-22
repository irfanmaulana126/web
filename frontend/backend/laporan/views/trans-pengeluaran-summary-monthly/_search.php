<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\laporan\models\TransPengeluaranSummaryMonthlySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trans-pengeluaran-summary-monthly-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'TAHUN') ?>

    <?= $form->field($model, 'BULAN') ?>

    <?php // echo $form->field($model, 'TTL_1') ?>

    <?php // echo $form->field($model, 'TTL_2') ?>

    <?php // echo $form->field($model, 'TTL_3') ?>

    <?php // echo $form->field($model, 'TTL_4') ?>

    <?php // echo $form->field($model, 'TTL_5') ?>

    <?php // echo $form->field($model, 'TTL_6') ?>

    <?php // echo $form->field($model, 'TTL_7') ?>

    <?php // echo $form->field($model, 'TTL_8') ?>

    <?php // echo $form->field($model, 'TTL_9') ?>

    <?php // echo $form->field($model, 'CNT_1') ?>

    <?php // echo $form->field($model, 'CNT_2') ?>

    <?php // echo $form->field($model, 'CNT_3') ?>

    <?php // echo $form->field($model, 'CNT_4') ?>

    <?php // echo $form->field($model, 'CNT_5') ?>

    <?php // echo $form->field($model, 'CNT_6') ?>

    <?php // echo $form->field($model, 'CNT_7') ?>

    <?php // echo $form->field($model, 'CNT_8') ?>

    <?php // echo $form->field($model, 'CNT_9') ?>

    <?php // echo $form->field($model, 'KETERANGAN') ?>

    <?php // echo $form->field($model, 'STATUS') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
