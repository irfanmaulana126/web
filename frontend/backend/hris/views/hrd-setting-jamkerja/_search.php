<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\hris\models\HrdSettingJamkerjaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hrd-setting-jamkerja-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ACCESS_GROUP') ?>

    <?= $form->field($model, 'STORE_ID') ?>

    <?= $form->field($model, 'SHIFT_ID') ?>

    <?= $form->field($model, 'SHIFT_NM') ?>

    <?php // echo $form->field($model, 'RENTANG_BAWAH') ?>

    <?php // echo $form->field($model, 'RENTANG_ATAS') ?>

    <?php // echo $form->field($model, 'RENTANG_TENGAH') ?>

    <?php // echo $form->field($model, 'SHIFT_IN_BATAS_BAWAH') ?>

    <?php // echo $form->field($model, 'SHIFT_IN_BATAS_SEQ') ?>

    <?php // echo $form->field($model, 'SHIFT_IN_BATAS_ATAS') ?>

    <?php // echo $form->field($model, 'SHIFT_IN') ?>

    <?php // echo $form->field($model, 'SHIFT_OUT') ?>

    <?php // echo $form->field($model, 'SHIFT_SEQ') ?>

    <?php // echo $form->field($model, 'RADIUS_KOORDINAT') ?>

    <?php // echo $form->field($model, 'TOLERANSI_TELAT') ?>

    <?php // echo $form->field($model, 'TOLERANSI_PULANG') ?>

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
