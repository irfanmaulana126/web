<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdAbsenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-absen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ABSEN_ID') ?>

    <?= $form->field($model, 'OFLINE_ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?php // echo $form->field($model, 'KARYAWAN_ID') ?>

    <?php // echo $form->field($model, 'TGL') ?>

    <?php // echo $form->field($model, 'WAKTU') ?>

    <?php // echo $form->field($model, 'LATITUDE') ?>

    <?php // echo $form->field($model, 'LONGITUDE') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

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
